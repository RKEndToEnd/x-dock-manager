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
* Control Tower – preview of current operations
https://www.rkendtoend.pl/xdockmanager/public/api/tower
* Departed Tracks - preview of finished operations
https://www.rkendtoend.pl/xdockmanager/public/api/departed
## In production
* Arrived module
* Statistic module - for KPI monitoring from app, withou excel import
* Management of warehouse equipment: lifts, scanners, workstations - for more effective warehouse management


## PL X-Dock Manager - aplikacja do zarządzania procesami w magazynach typu cross-dock
## Środowisko aplikacji
* Laravel 8
* JQuerry
* Bootstrap 5
* SQL
## Opis aplikacji X-Dock Manager
#### Aplikacja służy do zarządzania procesami przeładunkowymi w magazynach typu cross-dock. Może być wykorzystana w obszarze transportu całopaletowego jak również w obszarze przesyłek drobnicowych. Aplikacja monitoruje kluczowe elementy w procesie mające wpływ na koszt operacji przeładunkowej:
*	Ilość frachtu
*	Czas przewidziany na przeładunek jednostki transportowej (może to być czas na przeładunek jednej palety, lub czas na przeładunek jednego środka transportu – w przypadku przesyłek drobnicowych)
* Zaplanowana godzina wyjazdu/przyjazdu – jest kluczowym punktem odniesienia dla całego procesu przeładunku.
## Korzyści biznesowe z zastosowania X-Dock Managera
*	Automatyzacja procesów przeładunkowych
*	Zarządzanie rampami: podstawienia, statusy ramp - w tym możliwość nadawania własnych statusów
*	Zarządzanie pracownikami: przypisywanie zadań, zarządzanie uprawnieniami dostępu
*	Monitorowanie procesu: czasy przeładunków, terminowość podstawień i wyjazdów
*	Monitoring KPI - eksport raportu z przeładunków do Excela
## Podstawowe funkcje
* Zarządzanie przeładunkami
* Import tras z pliku excel umożliwia korzystanie z danych z systemu TMS
* Eksport danych dotyczących przeładowanych tras do excela
* Monitorowanie czasów wyjazdu, alerty w przypadku braku podstawień
* Czasy podstawień wyliczane na podstawie czasu odjazu i predefiniowanego przelicznika czas/jednostka transportowa lub czas/środek transportu
* W trybie zwykłego uzytkownika zablokowanma jest możliwość nadpisania wprowadzonych danych, zwiększa to wiarygodność KPI
* Zarzadzanie użytkownikami
* Zarządzanie uprawnieniami użytkowników
* Zarządzanie rampami
* Zarządzanie depotami
## Moduły
#### Aplikacja składa się z 3 modułów:
*	Operacje – zawiera tablice operacyjna przeładunków oraz tablicę tras przeładowanych
*	Zarządzanie – moduł administracyjny do zarządzania użytkownikami, depotami, rampami
*	Ustawienia – moduł do zarządzania poziomami dostępu użytkowników do aplikacji
#### Moduły są dostępne w zależności od poziomu uprawnień użytkownika.
## Poziomy uprawnień w aplikacji
#### Domyślnie zdefiniowanych jest 5 poziomów dostępu do aplikacji:
*	Super Admin – użytkownik ma dostęp bez ograniczeń
*	Admin – użytkownik ma dostęp do większości funkcji, oprócz definiowania poziomu uprawnień, usuwania: użytkowników, depotów
*	Moderator – podgląd: użytkowników, depotów, ramp, statusów ramp; tablica tras przeładowanych, tablica operacyjna przeładunków: CRUD oprócz kasowania tras, wszystkie opcje operacyjne – bez edycji tras dla których przeładunki zostały rozpoczęte
*	User – tablica operacyjna przeładunków: wszystkie opcje operacyjne, tablica tras przeładowanych
*	Observer – tablica operacyjna przeładunków: podgląd, tablica tras przeładowanych
## Public API
#### Aplikacja wystawia publiczne API:
*	Control Tower – możliwość podglądu bieżących operacji
https://www.rkendtoend.pl/xdockmanager/public/api/tower
* Trasy przeładowane – możliwość podglądu tras przeładowanych
https://www.rkendtoend.pl/xdockmanager/public/api/departed
## Moduły w produckji
* Zarządzanie przyjazdami
* Moduł statystyczne - mozliwośc monitorowania i analizy KPI bezpoiśrednio w aplikacji, bez konieczności exportu do excela
* Zarządzanie sprzętem magazynowym - wózki, skanery, stacje robocze itp., dla bardziej efektywanego zarządzania pracą magazynu

