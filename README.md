Krzysztof Osiejewski 80258

## Projekt Biura Podróży
## Użyte technologie: 
-Laravel</br>
-Bootstrap</br>
-JQuery</br>
-PostgreSQL</br>
-PHP</br>
-SCSS</br>
-JavaScript</br>
## Biblioteki oraz plug-in'y: 
-animate.css - używana do animacji widocznych na stronie(np. wysuwające się div'y)</br>
-JQuery - używana w celu ułatwienia obsługi JS</br>
-DataTables - plugin używany do tworzenia responsywnych Tabel w widokach aministratora i moderatora</br>
## Instalacja:
-node.js</br>
-php (np. wystarczy zainstalować xampp)</br>
-composer</br>
-Konfiguracja połączenia z bazą danych:
edytujemy zmienne dotyczące bazy w pliku .env
oraz odkomentowujemy dwie linie pgsql w pliku php.ini w folderze php(jeśli zainstalowaliśmy XAMPP jest w folderze xampp)
## Kompilacja:
npm install</br>
npm run build</br>
npm run dev</br>

## Uruchomienie serwera artisan
php artisan serve

## OPIS SYSTEMU, Funkcjonalności, ppodział na role
Aplikacja internetowa „Smak Wakacji” ma na celu zaoferowanie potencjalnym klientom usług biura podróży. Przedstawia wyszukiwarkę ofert podróży wraz z ich opisami. Ułatwia klientom wybór konkretnej oferty poprzez filtrowanie ich wedle preferencji (cena, promocje, all inclusive, last minute, data początkowa/końcowa, kraj, miasto,region). Strona jest w pełni responsywna. W aplikacji możemy wyróżnić 3 użytkowników: administratora, użytkownika niezalogowanego(gościa) oraz użytkownika zalogowanego(klienta). 
</br>
# Użytkownik niezalogowany może:</br>
•	Przeglądać oferty</br>
  o	Filtrować oferty</br>
•	Zalogować się</br>
•	Zarejestrować się</br>

# Użytkownik zalogowany(Klient) może:</br>
•	Wylogować się</br>
•	Przeglądać oferty</br>
  o	Filtrować oferty</br>
•	Dokonać zakupu oferty</br>

# Administrator może:</br>
•	Wylogować się</br>
•	Nadawać użytkownikom odpowiednie uprawnienia</br>

# Moderator może:</br>
•	Wylogować się</br>
•	Tworzyć nowe oferty</br>
  o	Dodać zdjęcie główne</br>
  o	Dodać zdjęcia poboczne do galerii</br>
  o	Dodać poszczególne opisy</br>
  o Podać cenę, cenę promocyjną, daty wyświetlania oferty, itp.</br>
•	Edytować oferty</br>
•	Usuwać oferty</br>
•	Podejrzeć oferty</br>
•	Podejrzeć istniejące zamówienia</br>

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
