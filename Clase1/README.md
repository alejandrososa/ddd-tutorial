Principios S.O.L.I.D
===

Son cinco principios fundamentales, uno por cada letra, que hablan del diseño orientado a objetos en términos de la 
gestión de dependencias. Las dependencias entre unas clases y otras son las que hacen al código más frágil o más robusto 
y reutilizable. El problema con el modelado tradicional es que no se ocupa en profundidad de la gestión de dependencias 
entre clases sino de la conceptualización. Quién decidió resaltar estos principios y darles nombre a algunos de ellos fue 
Robert C. Martin, allá por el año 1995.


## Single Responsibility Principle (SRP)

El principio que da origen a la S de S.O.L.I.D es el de una *única responsabilidad* y dice que cada clase debe ocuparse de 
un solo menester. Visto de otro modo, R. Martin dice que cada clase debería tener un único motivo para ser modificada.

Si estamos delante de una clase que se podría ver obligada a cambiar ante una modificación en la base de datos y a la vez, 
ante un cambio en el proceso de negocio, podemos afirmar que dicha clase tiene más de una responsabilidad o más de un 
motivo para cambiar, por poner un ejemplo.

Se aplica tanto a la clase como a cada uno de sus métodos, con lo que cada método también debería tener un solo motivo 
para cambiar. El efecto que produce este principio son clases con nombres muy descriptivos y por tanto largos, que tienen 
menos de cinco métodos, cada uno también con nombres que sirven perfectamente de documentación, es decir, de varias palabras: 
CalcularAreaRectangulo y que no contienen más de 15 líneas de código.

En la práctica la mayoría de mis clases tienen uno o dos métodos nada más. Este principio es quizás el más importante de 
todos, el más sencillo y a la vez el más complicado de llevar a cabo.


Allá por el año 1989, Kent Beck y Ward Cunningham usaban tarjetas CRC (Class, Responsibility, Collaboration) como ayuda 
para detectar responsabilidades y colaboraciones entre clases. Cada tarjeta es para una entidad, no necesariamente una 
clase. Desde que disponemos de herramientas que nos permiten el desarrollo dirigido por tests,las tarjetas CRC han pasado 
a un segundo plano pero puede ser buena idea usarlas parcialmente para casos donde no terminamos de ver claras las 
responsabilidades.

Al código!!!

Tenemos una clase que puede tener un pequeño parecido a muchas clases que hemos desarrollado:

```
class SalesReporter {
    public function beetween($startDate, $endDate, $format){
    
        // perform authentication
        if (! Auth::check() ) throw new Exception('Authentication required for reporting');
        
        // get sales from db
        $sales = $this->queryDBForSalesBetween($startDate,$endDate);
        
        // return results
        if($format == "html"){
            return $sales->formatHtml($sales);
        }else{
            return $sales->formatJson($sales);
        }
    }
    protected function queryDBForSalesBetween($startDate,$endDate){
        return DB::table('sales')->whereBetween('created_at',[$startDate,$endDate])->sum('charge')/100;
    }
    protected function formatHtml($sales){
        return "<h1>Sales: $sales</h1>";
    }
    protected function formatJson($sales){
        return json_encode($sales);
    }
}

```

- ¿Por qué el SalesReporter tiene interés en el usuario autenticado? Esa es la lógica de la aplicación y no pertenece 
a la clase SalesReporter.
- ¿Por qué SalesReporter tiene la responsabilidad de consultar la base de datos? 
- ¿por qué tiene que entender cuál es nuestra capa persistente si se obtienen datos o cómo?
- ¿Por qué SalesReporter es responsable de formatear el resultado? 
- ¿No sería necesario cambiar la clase SalesReporter si se cambian las necesidades de formateo? 

Entonces, si las necesidades de formato cambian y la capa persistente también cambia, habría dos razones para modificar 
la clase SalesReporter, lo cual va en contra del principio.

Solución:

```
interface SalesOutputInterface {
    public function output($sales);
}

class HtmlOutput implements SalesOutputInterface {
    public function output($sales)
    {
        return "<h1>Sales: $sales</h1>";
    }
}

class JsonOutput implements SalesOutputInterface {
    public function output($sales)
    {
        return json_encode($sales);
    }
}

class SalesRepository
{
    public function between($startDate,$endDate){
        return DB::table('sales')->whereBetween('created_at',[$startDate,$endDate])->sum('charge')/100;
    }
}
```
Con estos cambios ahora nuestra clase SalesReporter quedaría así:

```
class SalesReporter {
    /**
     * @var SalesRepository
     */
    private $repo;
    
    public function __construct(SalesRepository $repo)
    {
        $this->repo = $repo;
    }
    public function beetween($startDate, $endDate, SalesOutputInterface $formatter){
        $sales = $this->repo->between($startDate,$endDate);
        return $formatter->output($sales);
    }
}

----
 
$salesReport = new SalesReport(new SalesRepository());

//html result 
echo $salesReport->beetween('2018-01-01','2018-01-10',new HtmlOutput());

//Json result 
echo $salesReport->beetween('2018-01-01','2018-01-10',new JsonOutput());

```

La solución aquí fue crear una clase especializada responsable de recuperar los datos de la base de datos 
(SalesRepository) e insertarlos en el constructor del SalesReporter.
La responsabilidad de formatear la salida se pasó a una implementación de SalesOutputInterface, la salida deseada se 
implementó en la clase HtmlOutput, por lo que si se necesita un nuevo tipo de formato, SalesReporter no necesita cambiar.


## Open-Closed Principle (OCP)

Una entidad software (una clase, módulo o función) debe estar abierta a extensiones pero cerrada a modificaciones. 
Puesto que el software requiere cambios y que unas entidades dependen de otras, las modificaciones en el código de una 
de ellas puede generar indeseables efectos colaterales en cascada.

Para evitarlo, el principio dice que el comportamiento de una entidad debe poder ser alterado sin tener que modificar 
su propio código fuente. ¿Cómo se hace esto?, Hay varias técnicas dependiendo del diseño, una podría ser mediante 
herencia y redefinición de los métodos de la clase padre, donde dicha clase padre podría incluso ser abstracta. La otra 
podría ser inyectando dependencias que cumplen el mismo contrato (que tienen la misma interfaz) pero que implementan 
diferente funcionamiento.

En próximos párrafos estudiaremos la inyección de dependencias. Como la totalidad del código no se puede ni se debe 
cerrar a cambios, el diseñador debe decidir contra cuáles protegerse mediante este principio. Su aplicación requiere 
bastante experiencia, no sólo por la dificultad de crear entidades de comportamiento extensible sino por el peligro que 
conlleva cerrar determinadas entidades o parte de ellas.

Cerrar en exceso obliga aescribir demasiadas líneas de código a la hora de reutilizar la entidad en cuestión. El nombre 
de Open-Closed se lo debemos a Bertrand Meyer y data del año 1988. En español podemos denominarlo el principio 
Abierto-Cerrado. Para ejemplos de código léase el artículo original de R. Martin.

```
class Rectangle
{
    public $width;
    public $height;
    public function __construct($height, $width)
    {
        $this->height = $height;
        $this->width  = $width;
    }
}

class Circle
{
    public $radius;
    public function __construct($radius)
    {
        $this->radius = $radius;
    }
}

class AreaCalculator {
    public function calculate($shapes){
        foreach ($shapes as $shape)
        {
            if ($shape instanceof Rectangle){
                $area[] = $shape->width * $shape->heigth;
            }elseif (is_a($shape,'Circle')){ // same as instanceof
                $area[] = $shape->radius * $shape->radius * pi();
            }
        }
        return array_sum($area);
    }
}
```
Solución

```
interface Shape {
    public function area();
}
class Circle implements Shape
{
    public $radius;
    public function __construct($radius)
    {
        $this->radius = $radius;
    }
    public function area()
    {
        return $this->radius * $this->radius * pi();
    }
}
class Rectangle implements Shape
{
    public $width;
    public $height;
    public function __construct($height, $width)
    {
        $this->height = $height;
        $this->width  = $width;
    }
    public function area()
    {
        return  $this->width * $this->height;
    }
}
class AreaCalculator {
    public function calculate($shapes){
        foreach ($shapes as $shape)
        {
            $area[] = $shape->area();
        }
        return array_sum($area);
    }
}
```

## Liskov Substitution Principle (LSP)

Introducido por Barbara Liskov en 1987, lo que viene diciendo es que si una función recibe un objeto como parámetro, de 
tipo X y en su lugar le pasamos otro de tipo Y, que hereda de X, dicha función debe proceder correctamente.

Por el propio polimorfismo, los compiladores e intérpretes admiten este paso de parámetros, la cuestión es si la función 
de verdad está diseñada para hacer lo que debe, aunque quien recibe como parámetro no es exactamente X, sino Y.

El principio de sustitución de Liskov está estrechamente relacionado con el anterior en cuanto a la extensibilidad de 
las clases cuando ésta se realiza mediante herencia o subtipos. Si una función no cumple el LSP entonces rompe el OCP 
puesto que para ser capaz de funcionar con subtipos (clases hijas) necesita saber demasiado de la clase padre y por 
tanto, modificarla. El diseño por contrato (Design by Contract) es otra forma de llamar al LSP. Léase el artículo de 
R. Martin sobre este principio.
```
class Bird {
    public function fly(){ echo "I can fly." . PHP_EOL; }
    public function eat(){ echo "I can eat." . PHP_EOL; }
}
class Crow extends Bird {}

class Ostrich extends Bird {
    public function fly(){
        echo "Opss, I forgot to fly" . PHP_EOL;
    }
}

$birdList = [ new Bird(), new Crow(), new Ostrich() ];
foreach ($birdList as $bird) {
    /** @var Bird $bird */
    $bird->fly();
}
```

Solución

```
class Bird {
    public function eat(){ echo "I can eat." . PHP_EOL; }
}
class FlightBird extends Bird {
    public function fly(){ echo "I can fly." . PHP_EOL; }
}
class NonFlightBird extends Bird {}

class Crow extends FlightBird {}
class Ostrich extends NonFlightBird {}

```


## Interface Segregation Principle (ISP)

Cuando empleamos el SRP también empleamos el ISP como efecto colateral. El ISP defiende que no obliguemos a los clientes 
a depender de clases o interfaces que no necesitan usar. Tal imposición ocurre cuando una clase o interfaz tiene más 
métodos de los que un cliente (otra clase o entidad) necesita para sí mismo. Seguramente sirve a varios objetos cliente 
con responsabilidades diferentes, con lo que debería estar dividida en varias entidades.

En los lenguajes como Java y C# hablamos de interfaces pero en lenguajes interpretados como Python, que no requieren 
interfaces, hablamos de clases. No sólo es por motivos de robustez del software, sino también por motivos de despliegue. 
Cuando un cliente depende de una interfaz con funcionalidad que no utiliza, se convierte en dependiente de otro cliente 
y la posibilidad de catástrofe frente a cambios en la interfaz o clase base se multiplica. Léase el artículo de R. Martin.
```
interface Vehicle {
	public function turnOn();
	public function run();
	public function fuel();
}
class Motorcycle implements Vehicle {
    public function turnOn()
    {
        echo 'Motorcycle Turning on...';
    }
    public function run()
    {
        echo 'Motorcycle running...';
    }
    public function fuel()
    {
        echo 'Fuel the Motorcycle';
    }
}
class Bicycle implements Vehicle {
	public function turnOn() 
	{
		//does nothing, because bicycles doesn't turn on
	}
	
	public function run() 
	{
		echo 'Bicycle running...';
	}
	
	public function fuel() 
	{
	    //does nothing, because bicycles doesn't turn on
	}
}
```
Solución
```
interface Vehicle {
	public function run();
}
interface AutomotiveVehicle extends Vehicle {
    public function turnOn();
    public function fuel();
}
class Motorcycle implements AutomotiveVehicle {
    public function turnOn()
    {
        echo 'Motorcycle Turning on...';
    }
    public function run()
    {
        echo 'Motorcycle running...';
    }
    public function fuel()
    {
        echo 'Fuel the Motorcycle';
    }
}
class Bicycle implements Vehicle  {
	public function run() 
	{
		echo 'Bicycle running...';
	}
}
```
## Dependency Inversión Principle (DIP)

La inversión de dependencias da origen a la conocida inyección de dependencias, una de las mejores técnicas para lidiar 
con las colaboraciones entre clases, produciendo un código reutilizable, sobrio y preparado para cambiar sin producir 
efectos bola de nieve.

DIP explica que un módulo concreto A, no debe depender directamente de otro módulo concreto B, sino de una abstracción 
de B. Tal abstracción es una interfaz o una clase (que podría ser abstracta) que sirve de base para un conjunto de 
lases hijas.

En el caso de un lenguaje interpretado no necesitamos definir interfaces, ni siquiera jerarquías pero el concepto se 
aplica igualmente. Veámoslo con un ejemplo sencillo: La clase Logica necesita de un colaborador para guardar el dato 
Dato en algún lugar persistente. Disponemos de una clase MyBD que es capaz de almacenar Dato en una base de datos MySQL 
y de una clase FS que es capaz de almacenar Dato en un fichero binario sobre un sistema de ficheros NTFS.

Si en el código de Logica escribimos literalmente el nombre de la clase MyBD como colaborador para persistir datos, 
¿Cómo haremos cuando necesitamos cambiar la base de datos por ficheros binarios en disco?. No quedará otro remedio que 
modificar el código de Logica.

Si las clases MyDB y FS implementasen una misma interfaz IPersistor para guardar Dato, podríamos limitarnos a usar 
IPersistor (que es una abstracción) en el código de Logica. Cuando los requerimientos exigiesen un cambio de base de 
datos por ficheros en disco o viceversa, sólo tendríamos que preocuparnos de que el atributo _myPersistor de la clase 
Logica, que es de tipo IPersistor contuviese una instancia de MyDB o bien de FS.

¿Cómo resolvemos esta última parte?. Con la inyección de dependencias, que vamos a ver dentro del siguiente apartado, 
Inversión del Control. En los próximos capítulos haremos mucho uso de la inyección de dependencias con gran cantidad de 
listados de código. No se preocupe si el ejemplo no le queda demasiado claro. El artículo de R. Martin sobre DIP es uno 
de los más amenos y divertidos sobre los principios S.O.L.I.D.
```
class Computer
{
    public function on() {}
}
class Tv
{
    public function on() {}
}
class Button
{
    private $computer;
    
    public function __construct()
    {
        $this->computer = new Computer();
    }

    public function activate()
    {
        $this->computer->on();
    }
}
```

Solución

```
interface PowerDevice
{
   public function on();
   public function off();
       
}
class Computer implements PowerDevice
{
    public function on()
    {
        echo 'Computer power on!';
    }
    
    public function off()
    {
        echo 'Computer power off...';
    }
}
class Tv implements PowerDevice
{
    public function on()
    {
        echo 'Tv power on!';
    }
    
    public function off()
    {
        echo 'Tv power off...';
    }
}
class Button 
{
    private $powerDevice;
    public function setPowerDevice(PowerDevice $powerDevice)
    {
        $this->powerDevice = $powerDevice;
    }
    
    public function turnOn()
    {
        $this->powerDevice->on();
    }
    
}
```