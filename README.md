# 📊 Symfony Crypto Rates API

API for retrieving cryptocurrency exchange rates from Binance (EUR/BTC, EUR/ETH, EUR/LTC).  
Rates are stored in MySQL every 5 minutes and exposed via API endpoints for charts and analytics.

---

## 🚀 Quick Start

### 1. Start Docker containers
```bash
docker-compose up -d
```

### 2. Install dependencies
```bash
docker exec -it symfony-php composer install
```

### 3. Run database migrations
```bash
docker exec -it symfony-php bin/console doctrine:migrations:migrate
```

### 4. Fetch initial rates
```bash
docker exec -it symfony-php php bin/console app:fetch-rates
```

------

📡 API Endpoints

### Get rates for the last 24 hours
```bash
curl "http://localhost:8080/api/rates/last-24h?pair=BTC/USDT"
```

```bash
### Get rates for a specific day
curl "http://localhost:8080/api/rates/day?pair=BTC/USDT&date=2025-12-12"
```
