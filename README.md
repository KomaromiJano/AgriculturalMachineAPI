# Mezőgazdasági Gépek Kölcsönzési Rendszere

Ez a projekt egy Laravel-alapú API-t implementál mezőgazdasági gépek kölcsönzésének kezelésére.

## Tartalomjegyzék

- [Rendszerkövetelmények](#rendszerkövetelmények)
- [Telepítés](#telepítés)
- [API Végpontok](#api-végpontok)
  - [Mezőgazdasági Gépek](#mezőgazdasági-gépek)
  - [Kölcsönzések](#kölcsönzések)
- [Adatmodellek](#adatmodellek)
  - [AgriculturalMachine (Mezőgazdasági Gép)](#agriculturalmachine-mezőgazdasági-gép)
  - [Rental (Kölcsönzés)](#rental-kölcsönzés)
- [Üzleti Logika](#üzleti-logika)
- [Fejlesztői Megjegyzések](#fejlesztői-megjegyzések)
- [Közreműködés](#közreműködés)
- [Licenc](#licenc)


## Rendszerkövetelmények

- PHP 7.4 vagy újabb
- Composer
- MySQL vagy más kompatibilis adatbázis
- Laravel 8.x

## Telepítés

1. Klónozza le a repository-t:
```
git clone https://github.com/your-username/agricultural-machine-rental.git
```

2. Lépjen be a projekt könyvtárába:
```
cd agricultural-machine-rental
```

3. Telepítse a függőségeket:
```
composer install
```

4. Másolja le a `.env.example` fájlt `.env` néven, és konfigurálja az adatbázis beállításokat:
```
cp .env.example .env
```
5. Generáljon egy alkalmazás kulcsot:
```
php artisan key:generate
```

6. Futtassa a migrációkat:
```
php artisan migrate
```

7. (Opcionális) Futtassa a seeder-t a tesztadatok betöltéséhez:
```
php artisan db:seed
```

## API Végpontok

### Mezőgazdasági Gépek

- `GET /api/machines`: Összes gép listázása
- `POST /api/machines`: Új gép hozzáadása
- `GET /api/machines/{id}`: Egy gép adatainak lekérése
- `PUT /api/machines/{id}`: Gép adatainak frissítése
- `DELETE /api/machines/{id}`: Gép törlése

### Kölcsönzések

- `GET /api/rentals`: Összes kölcsönzés listázása
- `POST /api/rentals`: Új kölcsönzés létrehozása
- `GET /api/rentals/{id}`: Egy kölcsönzés adatainak lekérése
- `DELETE /api/rentals/{id}`: Kölcsönzés törlése

## Adatmodellek

### AgriculturalMachine (Mezőgazdasági Gép)
```
{
"id": integer,
"name": string,
"licensePlate": string,
"dailyPrice": number,
"rentals": [
    {
    "id": integer,
    "rentalStart": string (date-time),
    "rentalEnd": string (date-time),
    "machineId": integer
    }
]
}
```

### Rental (Kölcsönzés)
```
{
"id": integer,
"rentalStart": string (date-time),
"rentalEnd": string (date-time),
"machineId": integer
}
```

## Üzleti Logika

- Nem lehet új kölcsönzést létrehozni, ha az adott időszakban a gép már ki van kölcsönözve.
- Gép nem törölhető, ha aktív kölcsönzése van.

## Fejlesztői Megjegyzések

- A projekt Laravel 8.x keretrendszert használ.
- Az adatbázis kapcsolatokat Eloquent ORM kezeli.
- A hibakezelés try-catch blokkokkal van megvalósítva a részletes hibaüzenetek érdekében.
- A validáció a Laravel beépített validációs rendszerét használja.

## Közreműködés

Ha hibát talál vagy fejlesztési javaslatai vannak, kérjük, nyisson egy issue-t vagy küldjön egy pull request-et.

## Licenc

Ez a projekt [MIT licenc](https://opensource.org/licenses/MIT) alatt áll.