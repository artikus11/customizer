# WordPress Customizer
Бибилиотека для создания настроек Кастомайзера. Интегрируется в тему.

## Штатные контроллеры
* Input Control (Text, Email, URL, Number, Hidden, Date)
* Checkbox Control
* Select Control
* Radio Control
* Dropdown Pages Control
* Textarea Control
* Color Control
* Media Control
* Image Control
* Cropped Image Control
* Date Time Control

## Дополнительные контроллеры
* Dropdown Select2  - выпадающий список
* Final Line  - резделитель
* Image Check Box - чекбокс картинками
* Image Radio Button - радиобатоны картинками
* Images Slider - слайдер
* Slider - бегунок
* Simple Notice - сообщение
* Single Accordion - аккордион
* Sortable Repeater - повторитель
* Text Radio Button - текстовый переключатель
* TinyMCE- поле с редактором
* Simple Title - заголовок
* Toggle Switch - переключатель

## Дополнительные панели
* Panel - дополнительная панель
* Section - секция внутри панели

## Подключение
Копируете в нужную папку в теме. Например в папку `includes` в корне темы.
В файле `functions.php` подключаем нужный файл
`require get_template_directory() . '/includes/customizer/customizer.php';`

## Changelog
### 1.0
* init