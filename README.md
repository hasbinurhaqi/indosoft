# PHP 8 + Laravel 9 + GraphQL + MongoDB 4.2.3 Example

### About Project

The application was developed using Docker, PHP, MongoDB and GraphQL. To start you only need [docker](https://docs.docker.com/engine/install/ubuntu/) 
and [docker-compose](https://docs.docker.com/compose/install/) installed on your machine.

#### How to start & run test

```
cp .env.example .env
docker-compose up --build -d
docker exec -it indosoft /bin/sh
composer run-script onboarding
```

#### How to Authentication

**POST** http://localhost/graphql/auth

```
mutation {
  signIn(
    email: "hasbinurhaqy@gmail.com",
    password: "user123)"
  )
  {
    status,
    id,
    name,
    email,
    token
  }
}

```

#### How to Query

**POST** http://localhost/graphql

```

####### Fetch All Vehicles
query FetchAllVehicles {
  Vehicles {
    id,
    tahun,
    warna,
    motor {
      mesin,
      suspensi,
      transmisi,
      sold
    },
    mobil {
      mesin,
      kapasitas_penumpang,
      tipe,
      sold
    }
  }
}

####### Find By Col
query FindVehiclesByCol {
  Vehicles(_id: "4958afe0-5fdc-11ed-900f-a12677dc6e1a") {
    id,
    tahun,
    warna
  }
}

####### Find By Vehicle Sold
query FindVehiclesBySold {
  Vehicles(sold: true) {
    id,
    tahun,
    warna,
    motor {
      mesin,
      suspensi,
      transmisi,
      sold
    },
    mobil {
      mesin,
      kapasitas_penumpang,
      tipe,
      sold
    },
  }
}

####### Updte Sold Vehicles
mutation vehicles {
  UpdateVehicleSold(
    vehicle_id: "4958afe0-5fdc-11ed-900f-a12677dc6e1a",
    vehicle_type: "motor",
    index: 0,
    sold: true
  ) {
    id,
    warna
    motor {
      mesin,
      suspensi,
      transmisi,
      sold
    },
    mobil {
      mesin,
      kapasitas_penumpang,
      tipe,
      sold
    }
  }
}

```

Made by [Hasbi Nurhaqi S.T](https://www.linkedin.com/in/hasbi-nurhaqi-a10a53241/).