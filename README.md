autor Krzysztof Osiejewski

# Projekt Biura Podróży
## OPIS SYSTEMU - funkcjonalności
Aplikacja internetowa „Smak Wakacji” ma na celu zaoferowanie potencjalnym klientom usług biura podróży. Przedstawia wyszukiwarkę ofert podróży wraz z ich opisami. Ułatwia klientom wybór konkretnej oferty poprzez sortowanie lub filtrowanie  ich wedle preferencji (cena, promocje, all inclusive, last minute, data początkowa/końcowa, kraj, miasto,region). Strona jest w pełni responsywna. W aplikacji możemy wyróżnić 3 użytkowników: administratora, użytkownika niezalogowanego(gościa) oraz użytkownika zalogowanego(klienta). Użytkownik niezalogowany może przeglądać i wyszukiwać oferty, natomiast w przypadku próby podjęcia kupna zostaje on przekierowany do ekrany logowania/rejestracji. Po zalogowaniu kient uzyskuje możliwość kupna, a także ma dostęp do historii własnych zakupów. Administrator zarządza utworzonymi użytkownikami i ma możliwość usuwania ich, bądź przydzielania odpowiednich ról. Natomiast moderator może tworzyć oferty, dodając odpowiednie opisy, dodatkowe lub obowiązkowe pola takie jak: tytuł, opis, cena, cena promocyjna, cena ubezpieczenia, all inclusive, last minute, itd., a także ma możliwość wprowadzenia ilości utworzonych ofert. Ilość tych ofert jest dekrementowana wraz z dokonanym zakupem, a oferty których ilość osiągnie wartość zero nie są już dostępne dla klienta. 
</br>
##Wymagania niefunkcjonalne
•	Aplikacja responsywna, intuicyjna, bezpieczna i łatwa w obsłudze
•	Wymaga dostępu do Internetu
•	Działa 24h na dobę
•	Działa na wielu przeglądarkach internetowych
# Podział na role i możliwości użytkowników
## Użytkownik niezalogowany może:</br>
•	Przeglądać oferty – oferty są wczytywane asynchronicznie, tak aby nie generować dużego obciążenia i nie wydłużać czasu ładowania witryny, strona ma wbudowaną paginację</br>
•	Sortować oferty – sortowanie dostępne po tytule, mieście, regionie, kraju</br>
  o	Filtrować oferty – wbudowana wyszukiwarka oraz szereg filtrów, takich jak daty początku/końca, promocje, zakres cenowy, last minute, all inclusive itp.</br>
•	Zalogować się</br>
•	Zarejestrować się</br>

## Użytkownik zalogowany(Klient) może:</br>
•	Wylogować się</br>
•	Przeglądać oferty – oferty są wczytywane asynchronicznie, tak aby nie generować dużego obciążenia i nie wydłużać czasu ładowania witryny, strona ma wbudowaną paginację</br>
•	Sortować oferty – sortowanie dostępne po tytule, mieście, regionie, kraju</br>
  o	Filtrować oferty – wbudowana wyszukiwarka oraz szereg filtrów, takich jak daty początku/końca, promocje, zakres cenowy, last minute, all inclusive itp.</br>
•	Dokonać zakupu oferty – przy zakupie może dokonać zmiany danych osobowych, które automatycznie są zaczytywane z jego konta, a także wybrać wariant danej oferty jeżeli posiada ona jakieś inne warianty zakupu.</br>
•	Przeglądać zakupione przez siebie oferty  - m.in. możliwość kontrolowania cen i zakresu dat danych podróży</br>
  o	Podejrzeć status oferty – może być zaakceptowana, zrealizowana, oczekująca</br>

## Administrator może:</br>
•	Wylogować się</br>
•	Nadawać użytkownikom odpowiednie uprawnienia – adminstratora, moderatora lub klienta</br>
•	Usuwać użytkowników – jest to dodatkowo zabezpieczone odpowiednim modalem 

## Moderator może:</br>
•	Wylogować się</br>
•	Tworzyć nowe oferty</br>
  o	Dodać zdjęcie główne – musi być w odpowiednim formacie</br>
  o	Dodać zdjęcia poboczne do galerii – muszą być w odpowiednim formacie</br>
  o	Dodać poszczególne opisy – krótki opis główny, opis all inclusive, miejsca pobytu, w cenie, zakwaterowania, hotelu, udogodnień dla niepełnosprawnych</br>
  o 	Podać cenę, cenę promocyjną, daty wyświetlania oferty, zakres dat trwania turnusu, all inclusive, last minute, cenę ubezpieczenia, ilość ofert, ilość osób, dane kontaktowe hotelu, miasto, region, kraj itp. - ilość nocy jest automatycznie wyliczana na podstawie zakresu trwania danego turnusu, a cena promocyjna jest wyliczana na podstawie procentowej wartości promocji i ceny regularnej</br>
•	Edytować oferty</br>
•	Usuwać oferty – jest to dodatkowo zabezpieczone odpowiednim modalem </br>
•	Podejrzeć oferty  – wówczas nie ma możliwości dokonania zakupu</br>
•	Podejrzeć istniejące zamówienia</br>
  o	Zmienić status oferty – może być zaakceptowana, zrealizowana, oczekująca, a zmiana dokonywana jest asynchronicznie bez dodatkowego przeładowywania strony</br>


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
1. Node.js – instalujemy wersję 16.18.0 lub nowszą Node.js</br>
Sprawdzamy czy nie jest już zainstalowany i wyświetlamy obecną wersję za pomocą polecenia:</br>
node -v </br>
Z oficjalnej strony pobieramy i instalujemy odpowiednią wersję:</br>
https://nodejs.org/en/download/releases/  </br>
Ewentualnie można zainstalować menadżer wersji Node – nvm i użyć polecenia:</br>
nvm use 16.18.0 </br>
2. npm - Nastepnie należy zainstalować interfejs wiersza poleceń npm w wersji 8.19.2 lub nowszej,
sprawdzamy czy nie jest już zainstalowany i wyświetlamy obecną wersję za pomocą polecenia: </br>
npm -v </br>
Instalujemy używając komendy:</br>
npm install</br>

3. PHP – instalujemy wersję 8.1.10 </br>
4. Composer – instalujemy wersję tego menadżera zależności PHP 2.5.1 lub nowszą</br>
5. Instalujemy pgAdmin4</br>
6. Konfiguracja połączenia z bazą danych:</br>
Tworzymy serwer zawierający naszą bazę danych w pgAdmin4, 
edytujemy zmienne dotyczące bazy w pliku .env :</br>
DB_CONNECTION=pgsql</br>
DB_HOST=127.0.0.1</br>
DB_PORT=5432</br>
DB_DATABASE=postgres</br>
DB_USERNAME=postgres</br>
DB_PASSWORD=2000613</br>
Odkomentowujemy dwie linie dotyczące pgsql w pliku php.ini w folderze php(jeśli zainstalowaliśmy XAMPP jest w folderze xampp): </br>
extension=php_pgsql.dll </br>
extension=php_pdo_pgsql.dll </br>


##  Kompilacja (komendy wpisujemy znajdując się w folderze biuropodrozy):
npm install</br>
npm run build</br>
npm run dev</br>
Następnie uruchomienie serwera artisan poleceniem:</br>
php artisan serve</br>


##  Diagram przypadków użycia:
 ![image](https://user-images.githubusercontent.com/80296885/223732992-f675fb09-71c3-4ed9-a563-1facf65bfc6f.png)</br>
##  Diagram stanów (Cykl życia oferty):
![image](https://user-images.githubusercontent.com/80296885/223733061-d2bbf3e8-52d1-468a-9ec1-3007b11727bf.png)</br>
##  Diagram sekwencji (rejestracja):
![image](https://user-images.githubusercontent.com/80296885/223733135-71271df7-b329-4029-9223-1e95d5b5f857.png)</br>
##  Diagram klas:
![image](https://user-images.githubusercontent.com/80296885/223733237-77a23e62-2ba2-472f-9485-8b35e2d11deb.png)</br>
## Diagram związków encji (ERD):
![image](https://user-images.githubusercontent.com/80296885/223735287-af675eb3-6b18-4fa9-951d-2b031b2578c0.png)</br>

## Wygląd strony głównej:
![image](https://user-images.githubusercontent.com/80296885/223734004-ea3f300c-81b9-4af1-bb7e-cbc303bf6f93.png)</br>
Elementami stałymi wszystkich stron są: panel nawigacyjny oraz stopka. Panel nawigacyjny znajduje się u góry ekranu, a jego zawartość zmienia się w zależności od uprawnień danego użytkownika, a także od tego czy jest on zalogowany. Stopka natomiast znajduje się u dołu witryny i zawiera informacje kontaktowe, a także przekierowania do social mediów i polityki prywatności. 
## Widok – przegląd ofert
![image](https://user-images.githubusercontent.com/80296885/223734318-a4b457f8-5496-4b52-b958-bfad97a05724.png)</br>
Po lewej stronie znajduje się panel służący do wyszukiwania ofert. W środkowej części, u góry widzimy możliwość sortowania oraz wyszukane oferty. Paginacja obejmuje 10 ofert na stronę( u dołu znajduje się odpowiedni przycisk). Oferty mają przekierowania do szybkiego wyszukiwania wycieczek do danego miasta/regionu/kraju. Po prawej stronie mamy panel z aktualnościami.
## Widok – podgląd oferty
![image](https://user-images.githubusercontent.com/80296885/223734523-57c38abf-30c3-4971-bfd3-ca6b108d403a.png)</br>
Zdjęcia znajdujące się w galerii u dołu automatycznie dobierają swoje wymiary i dzielą się na kafelki tak aby zajmowały długość całego wiersza/kilku wierszy. Po kliknięciu na dany obraz wyświetla nam się modal z wybranym powiększonym zdjęciem. 
## Widok – zakup oferty
![image](https://user-images.githubusercontent.com/80296885/223734726-69f8e557-ad68-41f8-8e84-61527b14dbf3.png)</br>
W tym widoku przed dokonaniem zakupu możemy wprowadzić zmiany w naszych danych osobowych. Jeżeli dana oferta posiada taką opcję mamy możliwość wybrania pomiędzy wariantem podstawowym a wariantem ubezpieczonym, w zależności od tego dobierana jest odpowiednia kwota. 
## Widok – zarządzanie ofertami
![image](https://user-images.githubusercontent.com/80296885/223734914-92c48973-223d-4444-9f67-b4808589fcbf.png)</br>
mModerator ma dostęp do wszystkich utworzonych ofert oraz może przejść do tworzenia nowych. Tabela posiada paginację wraz z możliwością ustalenia ilości pozycji na stronie oraz wyszukiwarką a także sortowaniem po poszczególnych kolumnach. Jest również w pełni responsywna, a kolumny które nie pomieszczą się na małym ekranie są chowane pod przyciskiem plus/minus. 
