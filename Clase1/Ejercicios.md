Ejercicios de Principios S.O.L.I.D
===

Son cinco principios fundamentales, uno por cada letra, que hablan del diseño orientado a objetos en términos de la 
gestión de dependencias. Las dependencias entre unas clases y otras son las que hacen al código más frágil o más robusto 
y reutilizable. El problema con el modelado tradicional es que no se ocupa en profundidad de la gestión de dependencias 
entre clases sino de la conceptualización. Quién decidió resaltar estos principios y darles nombre a algunos de ellos fue 
Robert C. Martin, allá por el año 1995.


## Single Responsibility Principle (SRP)

El principio que da origen a la S de S.O.L.I.D es el de una *única responsabilidad* y dice que cada clase debe ocuparse de 
un solo menester. Visto de otro modo, R. Martin dice que cada clase debería tener un único motivo para ser modificada.

## Open-Closed Principle (OCP)

Una entidad software (una clase, módulo o función) debe estar abierta a extensiones pero cerrada a modificaciones. 
Puesto que el software requiere cambios y que unas entidades dependen de otras, las modificaciones en el código de una 
de ellas puede generar indeseables efectos colaterales en cascada.


## Liskov Substitution Principle (LSP)

Introducido por Barbara Liskov en 1987, lo que viene diciendo es que si una función recibe un objeto como parámetro, de 
tipo X y en su lugar le pasamos otro de tipo Y, que hereda de X, dicha función debe proceder correctamente.

## Interface Segregation Principle (ISP)

Cuando empleamos el SRP también empleamos el ISP como efecto colateral. El ISP defiende que no obliguemos a los clientes 
a depender de clases o interfaces que no necesitan usar. Tal imposición ocurre cuando una clase o interfaz tiene más 
métodos de los que un cliente (otra clase o entidad) necesita para sí mismo. Seguramente sirve a varios objetos cliente 
con responsabilidades diferentes, con lo que debería estar dividida en varias entidades.

## Dependency Inversión Principle (DIP)

La inversión de dependencias da origen a la conocida inyección de dependencias, una de las mejores técnicas para lidiar 
con las colaboraciones entre clases, produciendo un código reutilizable, sobrio y preparado para cambiar sin producir 
efectos bola de nieve.
