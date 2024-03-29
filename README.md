# Google Integration

## Overview

This is a laravel laravel-package to help in google integration with two main services.
<br>
<ul>
    <li>Google Drive</li>
    <li>Google Sheets</li>
</ul>
<hr>

## Installation
install it with CL:<br>
`composer require eng-mahmoud-elgml/google-integration`
<br>
run `php artisan vendor:publish --provider="EngMahmoudElgml\GoogleIntegration\Providers\GoogleServiceProvide" --tag="config"` 

by default the package is handle google callback and return access token,
but you can override on it and use your own route and callback function and all you need in callback function is create object from `GoogleConnection` 
Class and use `handleCallback()` method and pass `$request['code']` to it which will return access token <br>

Now Create Your Google Project in google developers console and get the Oauth2-credentials
and download it as a json file get the values from the file and set it in google config file or .env file.

Also, You Will find in config/google.php an array called token you will get it after log in with Google Account
, to get google login link:<br>
you can create an object from `GoogleConnection` Class and use `getAuthUrl` methode to get the link

after login if the package handled google-callback itself:
you will get the access token directly after login, copy its values and paste it inside `token` array 
in `config/google.php`
<br>

Also, if you want to save the token in database you can pass your token manually when create any `GoogleFile` or `SpreadSheet` object as second parameter in constructor 
Now You Ready to Use The Package Features


## Usage

### 1- Google Drive Features

To use drive features you must create object from `GoogleFile` class and pass google file id in constructor 
then you can: 
<br>
**a- copy it** <br>
with `$googleFileObject->copy()` you can copy the file and if you want the copied one with  specific name you can pass the name in first parameter, otherwise the name will be a random number.
<br>
and if you want it in specific folder you can pass the folder id in second parameter.
<br>
**b- export it** <br>
with `$googleFileObject->export()` you can export the file content with default mime type `application/pdf` and if you want to change it you can pass mime type in first parameter.
but first take a look at:
[Supported mime types from Google](https://developers.google.com/drive/api/guides/ref-export-formats)
 <br>
And if you want to save it directly to your local disk you can pass the second parameter as your path and third one as file name.
<br>
**c- delete it** <br>
with `$googleFileObject->delete()` you can delete the file.
<br>
**d- share it** <br>
with `$googleFileObject->share($email,$role)` you can share the file with specific email and you can pass the role in second parameter as `reader` or `writer` or `owner`.

### 2- Google Sheets Features
To use Google Sheets features you must create object from `SpreadSheet` class and pass spreadsheet id in constructor 
then you can:
<br>
**a- List sheets in spreadsheet file** <br>
with `$spreadSheetObject->list()` you can get all sheets in spreadsheet file.
<br>
**b- Get sheet data (Read the sheet)** <br>
with `$spreadSheetObject->read($sheetName)` you can get all data in specific sheet in spreadsheet file. and you can get specific range of data by passing the range in second parameter.
<br>
Ex:
```php 
$spreadSheetObject->read('Sheet1','A1:B2');
```
**c- Update Cell Values** <br>
with `$spreadSheetObject->updateCells($sheetName,$cellesWithItsValues)` you can update cell values in specific sheet in spreadsheet file.
<br>
Ex:
```php
$spreadSheetObject->updateCells('Sheet1',[
    'A1'=>'value1',
    'B1'=>'value2',
    'A2'=>'value3',
    'B2'=>'value4',
]);
```

**d- Bulk Update To The Sheet** <br>
if you want to update all the cells in the sheet you can use `$spreadSheetObject->override($sheetName,$data)` and pass the sheet name in first parameter and the data in second parameter as array of arrays.
each array in the main array is a row in the sheet and each array inside it is a cell in the row.
Ex:
```php
$spreadSheetObject->override('Sheet1',[
    ['value1','value2'],
    ['value3','value4'],
]);
```
