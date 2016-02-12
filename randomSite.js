    function rand() {

        //An array of websites which will be chosen at random to send the user to
        var links = [
	    //Heli Attack 3 game
            "http://www.miniclip.com/games/heli-attack-3/en/#t-sd",
	    //Balloons tower defense game
	    "http://ninjakiwi.com/Games/Tower-Defense/Play/Bloons-Tower-Defense-5.html#.UzljpnVdVq8",
	    //CS:GO
	    "http://store.steampowered.com/app/730",
	    //Skull kid game
	    "http://www.skull-kid.org/play-skull-kid",
	    //reddit forums
	    "http://www.reddit.com/"
        ];

	//Finds the amount of links there are to be used in the random calculation
	//which sets the highest number that will be made
        var max = (links.length)

        // Creates a random number using Math.random
	//Math.floor is used to round it down to the nearest integer
	//Max is the highest number which could be output
        var randomNumber = Math.floor(Math.random()*max);

        //Choses the element from the array using the random number
        var link = links[randomNumber];

        // Redirect to the web page chosen from the array
        window.location = link;
    }
