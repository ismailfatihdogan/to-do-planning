## To-do Planning

<p>
    İki veya daha fazla provider'dan gelecek to-do iş bilgilerini çekerek development ekibine haftalık olarak paylaştıracak ve ekrana çıktısını verecek bir web uygulama geliştirme. Her provider servisinde task ismi, süre (saat olarak), zorluk derecesi verilmektedir. Toplam 5 developer var ve her developer’ın 1 saatte yapabildiği iş büyüklüğü aşağıda verildiği gibidir;
</p>
<table>
<thead>
<tr>
<th>Developer</th>
<th>Süre</th>
<th>Zorluk</th>
</tr>
</thead>
<tbody>
<tr>
<td>Developer 1</td>
<td>1h</td>
<td>1x</td>
</tr>
<tr>
<td>Developer 2</td>
<td>1h</td>
<td>2x</td>
</tr>
<tr>
<td>Developer 3</td>
<td>1h</td>
<td>3x</td>
</tr>
<tr>
<td>Developer 4</td>
<td>1h</td>
<td>4x</td>
</tr>
<tr>
<td>Developer 5</td>
<td>1h</td>
<td>5x</td>
</tr>
</tbody>
</table>

Developer’ların haftalık çalışma saat bilgisi environment'dan gelen ve değiştirilebilinir olan **WEEK_WORKING_HOURS=45** saat bilgisiyle, en kısa sürede işlerin bitmesini sağlayan bir algoritma ile haftalık developer bazında iş yapma programını ve işin minimum toplam kaç haftada biteceğini ekrana basacak bir ara yüz hazırlanması. 

Provider 1: http://www.mocky.io/v2/5d47f24c330000623fa3ebfa <br>
Provider 2: http://www.mocky.io/v2/5d47f235330000623fa3ebf7

Projeyi çalıştırmak için aşağıdaki komutları yürütün
````
docker-compose up -d

docker exec -it tdp-app php artisan migrate --seed
docker exec -it tdp-app php artisan todo:sync
````
