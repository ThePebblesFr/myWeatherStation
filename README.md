# myWeatherStation
Embedded Linux project

## Backend

Pour envoyer les données au serveur, nous utilisons des requêtes HTTP grâce à
la librairie jQuery. En ouvrant l’index présent sur la carte Raspberry-Pi, toutes les
30 secondes est envoyée une requête HTTP vers data.php, un fichier également
sur la Raspberry-Pi qui permet de renvoyer sous forme d’objet JSON les données
récoltées par la Raspberry-Pi. Une fois que cette requête se termine avec succès,
une seconde requête HTTP de type POST est envoyée vers notre serveur
personnel, sur une API que nous avons réalisé pour l’insertion des données dans
la base de données. Ensuite, nous avons créé une interface qui permet de
visualiser les données récoltées par la Raspberry-Pi.

## Frontend

L’IHM web se décompose en 4 pages :
- Home
- Temperature
- Humidity
- Pressure
Dans home, vous pourrez retrouver les différentes valeurs instantanées ainsi que
la date et l’heure. Si vous cliquez sur le bouton See details vous serez redirigé
vers les pages correspondantes.
Les 3 autres pages sont construites de la même façon. (Vous pouvez y accéder
avec le menu sur la gauche ou les boutons See details.) Vous trouverez sur la
gauche un graphique avec l’évolution de la variable au cours de la journée ainsi
que sa valeur minimale, moyenne et maximale. Sur la droite, vous aurez
l’historique de la variable avec sa valeur moyenne pour la journée
correspondante. Et si vous cliquez sur la date, cela vous donnera également le
détail de la journée correspondante.