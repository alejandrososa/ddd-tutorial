Ejercicios de Principios S.O.L.I.D
===

Son cinco principios fundamentales, uno por cada letra, que hablan del diseño orientado a objetos en términos de la 
gestión de dependencias. Las dependencias entre unas clases y otras son las que hacen al código más frágil o más robusto 
y reutilizable. El problema con el modelado tradicional es que no se ocupa en profundidad de la gestión de dependencias 
entre clases sino de la conceptualización. Quién decidió resaltar estos principios y darles nombre a algunos de ellos fue 
Robert C. Martin, allá por el año 1995.


## Single Responsibility Principle (SRP)

La clase FutballPlayerAndReferee es un monstrito que esta en su etapa de crecimiento, para evitar que siga crececiendo y 
volvernos locos, se pide implementar el principio de *única responsabilidad*. Pista: dividir estas clases.

## Open-Closed Principle (OCP)

Para evitar que el metodo `modify` crezca en la clase StringReplacement cada vez que necesiten reemplazar un texto en una
cadena, se pide implementar el principio de abierto-cerrado y que dicho metodo sea agnostico de lo que tiene que reemplazar 
y devolver. Pista: este metodo debe ser capaz de recibir una collección de filtros (array) e iterar sobre cada filtro y
retornar un string.


## Liskov Substitution Principle (LSP)

Tenemos una clase para filtrar códigos, y de momento se esta ocupando de poner lógica y comprobaciones que quizas otras
clases que hereden de esta no tendrán. Se pide implementar el principio Liskov, una pista: array_map 

## Interface Segregation Principle (ISP)

La clase BasketballPlayer hereda de una interface que le obliga a realizar acciones de defensa, ofensa y dar instrucciones a 
los jugadores. Se pide implementar el principio de segregación de interfaces para que la clase BasketballPlayer no sea
forzada a utilizar metodos que no necesita.

## Dependency Inversión Principle (DIP)

En este ejercicio tenemos un nuevo requisito en la empresa, debemos conectarnos tanto a una base de datos MySql como a 
Postgres, el código existente sólo fue desarrollado para conectarse a MySql. Se necesita utilizar el principio de Inversión 
de dependencias para lograr que la clase PasswordReminder se pueda conectar a una base de datos sin conocer su tipo.
