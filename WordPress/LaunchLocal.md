# ローカルで雑に起動

```
docker run --name test-mysql -e MYSQL_ROOT_PASSWORD=test-pw -d mysql:5.7.21
docker run --name test-wordpress --link test-mysql:mysql -d -p 8080:80 wordpress
```

