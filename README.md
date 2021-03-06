![Desktop-screenshot (87)](https://user-images.githubusercontent.com/79422696/156925775-25f66cd2-d017-4d7f-90dd-0d4e924ffadd.jpg)
## EN X-Dock Manager - application for  processes managing in cross-dock warehouses
## Enviroment
* Laravel 8
* JQuerry
* Bootsrap 5

* SQL
## Description of the application
#### Application can be used in the area of full-pallet transport as well as in the area of courier shipments. The application is monitoring the key elements in the process that affect the cost of the transshipment operation:
* Freeight quantity
* Time allocated on single shipment reloading or single transport unit (ex. truck)
* ETA time
## Business benefits
* Automation of business processes
* Ramp management
* Workers/users management
* Process monitoring
* KPI monitoring
## Basic functions
* Cross-dock operations management
* Track data excel import
* Departed tracks excel export
* ETA monitoring and delayed alerts
* Docking time count from ETA, freight quantity and predefined time converter for single shipment or full track
* KPI guard - user cannot change entered data, it needs user with higher level of permissions
* Users/workers management
* Users permissions management
* Ramps management
* Depots management
## Application modules![tablica ops](https://user-images.githubusercontent.com/79422696/156925850-30a6c9b9-281a-41c7-807a-39e1835f058c.jpg)

#### An application is build from 3 modules
* Operations - contains Control Tower table for current operations and Departed tracks table - for finished operations
* Management - module for users, ramps, depots management
* Settings - module for permissions management
#### The modules are available depending on the authorization level of the logged in user
## Authorization levels
#### Default in application are defined 5 levels of permissions
* Super-admin - unlimited access
* Admin - access for all features apart from: users permissions managemet and deleting: users, depots
* Moderator - access for: preview: users, depots, ramps, ramp statuses, departed tracks table. Access for Control Tower: all operations and CRUD apart from: updating started tracks. Departed tracks: preview
* User - Control tower: all operations, departed tracks: preview
* Observer: preview: control tower, departed tracks
## Public Api
* Control Tower ??? preview of current operations
https://www.rkendtoend.pl/xdockmanager/public/api/tower
* Departed Tracks - preview of finished operations
https://www.rkendtoend.pl/xdockmanager/public/api/departed
## In production
* Arrived module
* Statistic module - for KPI monitoring from app, withou excel import
* Management of warehouse equipment: lifts, scanners, workstations - for more effective warehouse management


## PL X-Dock Manager - aplikacja do zarz??dzania procesami w magazynach typu cross-dock
## ??rodowisko aplikacji
* Laravel 8
* JQuerry
* Bootstrap 5
* SQL
## Opis aplikacji X-Dock Manager
#### Aplikacja s??u??y do zarz??dzania procesami prze??adunkowymi w magazynach typu cross-dock. Mo??e by?? wykorzystana w obszarze transportu ca??opaletowego jak r??wnie?? w obszarze przesy??ek drobnicowych. Aplikacja monitoruje kluczowe elementy w procesie maj??ce wp??yw na koszt operacji prze??adunkowej:
*	Ilo???? frachtu
*	Czas przewidziany na prze??adunek jednostki transportowej (mo??e to by?? czas na prze??adunek jednej palety, lub czas na prze??adunek jednego ??rodka transportu ??? w przypadku przesy??ek drobnicowych)
* Zaplanowana godzina wyjazdu/przyjazdu ??? jest kluczowym punktem odniesienia dla ca??ego procesu prze??adunku.
## Korzy??ci biznesowe z zastosowania X-Dock Managera
*	Automatyzacja proces??w prze??adunkowych
*	Zarz??dzanie rampami: podstawienia, statusy ramp - w tym mo??liwo???? nadawania w??asnych status??w
*	Zarz??dzanie pracownikami: przypisywanie zada??, zarz??dzanie uprawnieniami dost??pu
*	Monitorowanie procesu: czasy prze??adunk??w, terminowo???? podstawie?? i wyjazd??w
*	Monitoring KPI - eksport raportu z prze??adunk??w do Excela
## Podstawowe funkcje
* Zarz??dzanie prze??adunkami
* Import tras z pliku excel umo??liwia korzystanie z danych z systemu TMS
* Eksport danych dotycz??cych prze??adowanych tras do excela
* Monitorowanie czas??w wyjazdu, alerty w przypadku braku podstawie??
* Czasy podstawie?? wyliczane na podstawie czasu odjazu i predefiniowanego przelicznika czas/jednostka transportowa lub czas/??rodek transportu
* W trybie zwyk??ego uzytkownika zablokowanma jest mo??liwo???? nadpisania wprowadzonych danych, zwi??ksza to wiarygodno???? KPI
* Zarzadzanie u??ytkownikami
* Zarz??dzanie uprawnieniami u??ytkownik??w
* Zarz??dzanie rampami
* Zarz??dzanie depotami
## Modu??y
#### Aplikacja sk??ada si?? z 3 modu????w:
*	Operacje ??? zawiera tablice operacyjna prze??adunk??w oraz tablic?? tras prze??adowanych
*	Zarz??dzanie ??? modu?? administracyjny do zarz??dzania u??ytkownikami, depotami, rampami
*	Ustawienia ??? modu?? do zarz??dzania poziomami dost??pu u??ytkownik??w do aplikacji
#### Modu??y s?? dost??pne w zale??no??ci od poziomu uprawnie?? u??ytkownika.
## Poziomy uprawnie?? w aplikacji
#### Domy??lnie zdefiniowanych jest 5 poziom??w dost??pu do aplikacji:
*	Super Admin ??? u??ytkownik ma dost??p bez ogranicze??
*	Admin ??? u??ytkownik ma dost??p do wi??kszo??ci funkcji, opr??cz definiowania poziomu uprawnie??, usuwania: u??ytkownik??w, depot??w
*	Moderator ??? podgl??d: u??ytkownik??w, depot??w, ramp, status??w ramp; tablica tras prze??adowanych, tablica operacyjna prze??adunk??w: CRUD opr??cz kasowania tras, wszystkie opcje operacyjne ??? bez edycji tras dla kt??rych prze??adunki zosta??y rozpocz??te
*	User ??? tablica operacyjna prze??adunk??w: wszystkie opcje operacyjne, tablica tras prze??adowanych
*	Observer ??? tablica operacyjna prze??adunk??w: podgl??d, tablica tras prze??adowanych
## Public API
#### Aplikacja wystawia publiczne API:
*	Control Tower ??? mo??liwo???? podgl??du bie????cych operacji
https://www.rkendtoend.pl/xdockmanager/public/api/tower
* Trasy prze??adowane ??? mo??liwo???? podgl??du tras prze??adowanych
https://www.rkendtoend.pl/xdockmanager/public/api/departed
## Modu??y w produckji
* Zarz??dzanie przyjazdami
* Modu?? statystyczne - mozliwo??c monitorowania i analizy KPI bezpoi??rednio w aplikacji, bez konieczno??ci exportu do excela
* Zarz??dzanie sprz??tem magazynowym - w??zki, skanery, stacje robocze itp., dla bardziej efektywanego zarz??dzania prac?? magazynu

