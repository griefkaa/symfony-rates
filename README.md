docker-compose up -d
docker exec -it symfony-php composer install
docker exec -it symfony-php bin/console d:m:m
docker exec -it symfony-php php bin/console app:fetch-rates

curl http://localhost:8080/api/rates/last-24h?pair=BTC/USDT
curl http://localhost:8080/api/rates/day?pair=BTC/USDT

todo: vault, auth, tests, mapping etc.
