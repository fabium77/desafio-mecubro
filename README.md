
# Desafio Mecubro

Esta ApiRest fue creada para el test de programacion solicitada por MasDos Consultora para Mecubro.

Lo que hace es responder a un peticion, analizar las secuencia de DNA. Son 3 las peticiones POST que se pueden hacer. Una Saber si un invididuo es sensible a la fuerza, obtener estadisticas de los DNA sencibles y no sensibles, tambien resetear las cadenas de DNA guardadas en la base de datos.

## Verificar si un invididuo es sencible a la fuerza

Para ellos tiene que mandar una peticion POST al siguiente link http://desafio-mecubro.fabiomolinasoft.com/force-users como clave la palabra "dna" y valor un array de tamaño 6 como la siguiente secuencia de DNA ["ATGCGA","CAGTGC","TTATGT","AGAAGG","CCCCTA","TCACTG"] Si la cadena esta mal recibira un error de validacion indicando que hay un error y debe ser corregido, en caso de que DNA sea sensible a la fuerza recibiras un 'HTTP 200-OK' en caso contrario '403-Forbidden'.

## Estadisticas

Para ellos tiene que mandar una peticion POST al siguiente link http://desafio-mecubro.fabiomolinasoft.com/stats  no hace falta enviar una clave valor. se recibira una estadistica con el siguiente formato como ejemplo {"force_user_dna": 20, "non_force_user_dna": 100, "ratio": 0.2}. donde force_user_dna son los invididuos sensibles a la fuerza, 
non_force_user_dna los no sensibles.

## Reset DNA

Para ellos tiene que mandar una peticion POST al siguiente link http://desafio-mecubro.fabiomolinasoft.com/reset no hace falta enviar una clave valor. con cuidado porque esto borrara todos los DNA que estan guardados en la base de datos.


## License

The Desafio-Mecubro is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
