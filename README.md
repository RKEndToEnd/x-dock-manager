## X-Dock Manager - aplikacja do zarządzania procesami w magazynach typu cross-dock
## Środowisko aplikacji
#### Aplikacja jest napisana w języku PHP 8 z wykorzystaniem frameworka Laravel 8 oraz biblioteki JQuerry. Część wizualna została wykonana w technologii Bootstrap 5. 
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
## Podstawowe funkcje:
* Zarządzanie przeładunkami
* Import tras z pliku excel umożliwia korzystanie z danych z systemu TMS
* Eksport danych dotyczących przeładowanych tras do excela
* Monitorowanie czasów wyjazdu, alerty w przypadku braku podstawień
* Czasy podstawień wyliczane na podstawie czasu odjazu i predefiniowanego przelicznika czas/jednostka transportowa lub czas/środek transportu
* W trybie zwykłego uzytkownika zablokowanma jest możliwość nadpisania wprowadzonych danych
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

