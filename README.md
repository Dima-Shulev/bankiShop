# bankiShop

**Разработать прототип хостинга изображений.**
Инструменты для реализации задания:
- фреймворк Laravel/Yii2
- mysql
 
**_1. Реализовать форму для загрузки изображений._**

   При загрузке изображений должны соблюдаться следующие правила:
- в 1 запрос, в одной форме, можно загружать до 5 файлов
- название каждого файла должно транслителироваться на английский язык и приводиться к нижнему регистру
- название каждого файла должно быть уникальным, и, если файл с таким названием существует, нужно задавать новому файлу уникальное название
- все файлы должны отправляться в одну директорию
- записывать в БД инфу о загруженных файлах: название файла, дата и время загрузки
  
**_2. Реализовать страницу просмотра информации об изображениях._**

   На странице должны быть реализованы:
- вывод информации о загруженных файлах (название файла, дата и время загрузки)
- просмотр превью изображения
- возможность просмотра оригинального изображения
- сортировка по названию/дате и времени загрузки изображения
- возможность скачать файл в zip архиве
 
**_3. Реализовать API_**
  
- вывод информации о загруженных файлах в json
- получить данные о загруженном файле по id в json
  Код задания необходимо выложить на github/gitlab/bitbucket.
  Бонусом будет возможность просмотра результата в общем доступе (например vds)
