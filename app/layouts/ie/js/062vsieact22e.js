/*----------------------------------------------------------------------------*\
 * Memory                                                                     *
 * Bei diesem Memory-Spiel handelt es sich um eine sehr einfache              *
 * Implementierung in JavaScript 1.2 mit einer festen Anzahl Bilder.          *
 *                                                                            *
 * Version 1.0.0 25.06.2002 Markus Eichenberger                               *
 * Version 1.0.1 02.08.2002 Jahr 2000 sicheres Datum                          *
\*----------------------------------------------------------------------------*/ 

 var IMG_OFFSET = 1;            // Nummer des ersten Bildes des Memorygames
  
 // Imagepositionen vorbelegen
 var IMG_START = 18 + IMG_OFFSET;
 var IMG_STOP  = 20 + IMG_OFFSET;
 var IMG_PLUS  = 28 + IMG_OFFSET;
 var IMG_MINUS = 24 + IMG_OFFSET;

 var IMG_LEVEL = 26 + IMG_OFFSET;
 var IMG_SEC   = 33 + IMG_OFFSET;
 var IMG_HIT   = 49 + IMG_OFFSET;
 var IMG_TRIAL = 41 + IMG_OFFSET;
 
 var nImages = 8;                               // Anzahl der Bilder
 var arrHighScore    = new Array();             // HighScore Objekt Array
 var imgArrField     = new Array(nImages * 2);  // Bilder im Spielfeld
 var imgKarte        = new Image();             // Rueckseite der Karte
 var imgArrStartStop = new Array(4);            // Start und Stop Button
 var imgArrPlusMinus = new Array(4);            // Plus und Minus Button
 var imgArrNumber    = new Array(11);           // Zahlen 0 bis 9
 var bRunning        = false;                   // Zustand des Spiels   
 var nLevel          =  4;                      // Spiellevel
 var nSeconds        =  0;                      // Anzahl Sekunden der Spieldauer
 var nAttempts       =  0;                      // Anzahl Versuche
 var nHit            =  0;                      // Anzahl Treffer
 var nSelected1      = -1;                      // Erstes selektiertes Bild
 var nSelected2      = -1;                      // Zweites selektiertes Bild
 var bShowCard       = false;                   // Zustand Karte Anzeigen
 var strPlayerName   = "xxx";                   // Name der Spielers
 var strDate         = "";                      // Datum des Spiels
 var nPoints         = 0;                       // Anzahl Punkte des Spiels
 var bCookies        = false;                   // Cookies
 
/*
 *  Bilder laden
 */
 function loadImages()
 {
   if(document.images)
   {
     imgKarte.src  = "images/karte.jpg";
     
     // Start und Stop Button
     for(var i = 0; i < 4; i++)
     {
       imgArrStartStop[i] = new Image();
       imgArrStartStop[i].src = "images/startstop" + (i + 1) + ".gif";
     }

     // Plus und Minus Button
     for(var i = 0; i < 4; i++)
     {
       imgArrPlusMinus[i] = new Image();
       imgArrPlusMinus[i].src = "images/plusminus" + (i + 1) + ".gif";
     }
     
     // Zahlen und Buchstaben laden
     for(var i = 0; i < 11; i++)
     {
       imgArrNumber[i] = new Image();
       imgArrNumber[i].src = "images/" + i + ".gif";
     }

     // Bilder laden
     for(var i = 0; i < nImages; i++)
     {
       img = new Image();
       img.src = "images/horse0" + (i + 1) + ".jpg";
    
       imgArrField[i * 2] = new Image();
       imgArrField[i * 2 + 1] = new Image();
       imgArrField[i * 2].src = img.src;
       imgArrField[i * 2 + 1].src = img.src;
     }
     
     loadHighScore();
     nLevel = 4;
     nSeconds  =  0;
     nAttempts =  0;
     nHit      =  0;
     updateAll();
   }   
 }
 
/*
 *  Bilder mischen
 */
 function shuffle()
 {
   if(document.images)
   {
     // Jeweils zwei Bilder vertauschen
     var j = Math.floor(new Date().getSeconds() * Math.random() + 60);
     for(var i = 0; i < j; i++)
     {
       n1 = Math.round(Math.random() * (nImages * 2 - 1));
       n2 = Math.round(Math.random() * (nImages * 2 - 1));
       img = imgArrField[n1];
       imgArrField[n1] = imgArrField[n2];
       imgArrField[n2] = img;
     } 
   }
 }
  
/*
 *  Neues Spiel starten
 */
 function startGame()
 {
   if(document.images)
   {
     if(!bRunning)
     {
       shuffle();
       clearField();
       nSeconds = 0;
       nSelected1 = -1;
       nSelected2 = -1;    
       nAttempts  =  0;
       nHit       =  0;
       id = setInterval("countSeconds()", 1000)
       bRunning = true;
       bShowCard = false;
       updateAll();
     }
   }
 }
  
/*
 *  Spiel stoppen
 */
 function stopGame()
 {
   if(document.images)
   {
     if(bRunning)
     {
       clearInterval(id);
       bRunning = false;
       updateAll();
     }
   }
   return;
 }
 
/*
 *  Sekunden z�hlen
 */
 function countSeconds()
 {
   nSeconds++;
   showNumber(nSeconds, IMG_SEC, 5);
 }
 
/*
 *  Zahl anzeigen
 */
 function showNumber(nNumber, nPosition, nCount)
 {
   if(document.images)
   {
     nNumber += "";
     while(nNumber.length < nCount) nNumber = " " + nNumber;
     for(var i = 0; i < nCount; i++)
     {
       var n = nNumber.charAt(i);
       if(n == " ")
       {
         document.images[nPosition + i].src = imgArrNumber[10].src;
       }
       else
       {
         document.images[nPosition + i].src = imgArrNumber[n].src;
       }
     }
   }
 }
 
/*
 *  Spielfeld loeschen
 */
 function clearField()
 {
   if(document.images)
   {
     for(var i = 0; i < nImages * 2; i++)
     {
       document.images[i + IMG_OFFSET].src = imgKarte.src;
     }
   }
 }   

/*
 *  Zeigen der Karte
 */
 function showCard(nImage)
 {
   if(document.images)
   {
     if(bRunning && !bShowCard)
     {
       // Aufdecken von zwei Karten
       if(nSelected1 == -1 || nSelected2 == -1)
       {
         // Nur zugedeckte Karten aufdecken
         if(document.images[nImage + IMG_OFFSET].src == imgKarte.src)
         {
           // Bild aufdecken
           document.images[nImage + IMG_OFFSET].src = imgArrField[nImage].src;
           if(nSelected1 == -1)
           {
             nSelected1 = nImage;
           }
           else
           {
             nSelected2 = nImage;
           }
         }
       }
       
       // Zwei Karten sind aufgedeckt
       if(nSelected1 != -1 && nSelected2 != -1)
       {
         showNumber(++nAttempts, IMG_TRIAL, 5);
                
         // Karten miteinander vergleichen
         if(document.images[nSelected1 + IMG_OFFSET].src == document.images[nSelected2 + IMG_OFFSET].src)
         {
           // Karten identisch, Counter erhoehen
           showNumber(++nHit, IMG_HIT, 5);
           nSelected1 = -1;
           nSelected2 = -1;
     
           // Alle Bilder aufgedeckt
           if(nHit == nImages)
           {
             stopGame();
            alert("Congratulations! You WON ! and You have spent "+nSeconds+" seconds");
		    alert("Click on OK for next level");
		   	 document.location="php/062vsieact22e.php?level="+nLevel+"&seconds="+nSeconds;
             if(strPlayerName != null && strPlayerName != "")
             {
               strDate = getY2kDate();
               nPoints = Math.round(100000 * (nLevel + 1) / nSeconds / nAttempts);
               arrHighScore.push(new objHighScore());
             }
           }
         }
         else
         {
           // Karten nicht identisch, nach n Sekunden wieder ausblenden, abhaengig vom Spiellevel
           bShowCard = true;
           setTimeout("clearCard()", 2000 - nLevel * 200);
         }
       }
     }
     else
     {
       if(!bRunning)
       {
         alert("Please Start the Game");
       }
     }
   }
 }
 
/*
 *  Zwei Karten wieder verdecken
 */
 function clearCard()
 {
   document.images[nSelected1 + IMG_OFFSET].src = imgKarte.src;
   document.images[nSelected2 + IMG_OFFSET].src = imgKarte.src;
   nSelected1 = -1;
   nSelected2 = -1;
   bShowCard = false;
  }
  
/*
 *  Spiellevel setzen
 */
 function setLevel(nValue)
 {
   if(document.images && !bRunning)
   {
     nLevel += nValue;
     if(nLevel < 0) nLevel = 0;
     if(nLevel > 9) nLevel = 9;
     showNumber(nLevel, IMG_LEVEL, 1);
   }
 }

  
/*
 *  Alle Zaehler neu anzeigen
 */
 function updateAll()
 {
   if(document.images)
   {
     showNumber(nLevel, IMG_LEVEL, 1);
     showNumber(nSeconds, IMG_SEC, 5);
     showNumber(nAttempts, IMG_TRIAL, 5);
     showNumber(nHit, IMG_HIT, 5);

     if(bRunning)
     { 
       document.images[IMG_START].src = imgArrStartStop[1].src;
       document.images[IMG_STOP].src  = imgArrStartStop[2].src;
       document.images[IMG_PLUS].src  = imgArrPlusMinus[1].src;
       document.images[IMG_MINUS].src = imgArrPlusMinus[3].src;
     }
     else
     {  
       document.images[IMG_START].src = imgArrStartStop[0].src;
       document.images[IMG_STOP].src  = imgArrStartStop[3].src;
       document.images[IMG_PLUS].src  = imgArrPlusMinus[0].src;
       document.images[IMG_MINUS].src = imgArrPlusMinus[2].src;
     }
   }
 }
  
/*
 *  HighScore anzeigen
 */
 function showHighScore()
 {
   sortHighScore();
   saveHighScore();
   window.open("highscore.html", "Highscore", "toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=600,height=300");
 }
 
/*
 *  HighScore Objekt
 */
 function objHighScore()
 {
   this.nPoints   = nPoints;
   this.strName   = strPlayerName;
   this.strDate   = strDate;
   this.nLevel    = nLevel;
   this.nSeconds  = nSeconds;
   this.nAttempts = nAttempts;
 }

/*
 *  HighScore sortieren nach Punktezahl (BubbleSort, sortieren durch Vertauschen)
 */
 function sortHighScore()
 {
   var l = arrHighScore.length;
   if(l > 1)
   {
     for(var n = 0; n < l - 1; n++)
     {
       for(var m = 0; m < l - 1; m++)
       {
         if((arrHighScore[m].nPoints - arrHighScore[m + 1].nPoints) > 0)
         {   
           var tmp = arrHighScore[m];
           arrHighScore[m] = arrHighScore[m + 1];
           arrHighScore[m + 1] = tmp;
         }
       }
     }
   }
 }


/*
 *  HighScore lesen
 */
 function loadHighScore()
 {
   if(document.cookie != "")
   {
     bCookies = true;

     // Die besten drei Spieler
     for(var i = 1; i < 4; i++)
     {
       var strCookieValue = getCookie("MemoryScore" + i);
       if(strCookieValue != "")
       {
         var arrValues = unescape(strCookieValue).split(";");
         nPoints       = arrValues[0];
         strPlayerName = arrValues[1];
         strDate       = arrValues[2];
         nLevel        = arrValues[3];
         nSeconds      = arrValues[4];
         nAttempts     = arrValues[5];
         arrHighScore.push(new objHighScore());
       }
     }
    
     strPlayerName = getCookie("MemoryPlayerName");   
   }
   else
   {
     // Es sind noch keine Cookies gespeichert, versuchen eines zu speichern
     setCookie("MemoryPlayerName", strPlayerName);
     if(document.cookie == "")
     {
       // Definitiv keine Cookies moeglich
       bCookies = false;
     }
     else
     {
       bCookies = true;
     }
   }
 }

 
/*
 *  HighScore speichern
 */
 function saveHighScore()
 {
   if(bCookies)
   {
     setCookie("MemoryPlayerName", strPlayerName);
   
     // Der beste drei Spieler
     if(arrHighScore.length != null)
     {
       var n = arrHighScore.length - 1;
       var j = 0;
       for(var i = n; i > n - 3; i--)
       {
         if(i >= 0)
         {
           var strCookieValue = "";
           strCookieValue += arrHighScore[i].nPoints + ";";
           strCookieValue += arrHighScore[i].strName + ";";
           strCookieValue += arrHighScore[i].strDate + ";";
           strCookieValue += arrHighScore[i].nLevel + ";";
           strCookieValue += arrHighScore[i].nSeconds + ";";
           strCookieValue += arrHighScore[i].nAttempts;
           setCookie("MemoryScore" + ++j, strCookieValue);
         }
       }
     }
   }
 }
  
/*
 *  Cookie lesen
 */
 function getCookie(strId)
 {
   var strReturn = "";

   if(document.cookie != "")
   {
     var arrCookies = document.cookie.split(";");
     for(var i = 0; i < arrCookies.length; i++)
     {
       var arrCookie = arrCookies[i].split("=");
       if(arrCookie.length == 2)
       {
         if(strTrim(arrCookie[0]) == strTrim(strId))
         {
           strReturn = unescape(arrCookie[1]);
         }
       }
     }
   }

   return strReturn;
 }
  
 /*
 *  Cookie setzen
 */
 function setCookie(strId, strValue)
 {
   document.cookie = strId + "=" + escape(strValue) + ";expires=" + new Date(2036, 12, 31).toGMTString();
 }
  
/*
 *  Leerzeichen aus String entfernen
 */
 function strTrim(str)
 {
   var strReturn = "";
   
   for(var i = 0; i < str.length; i++)
   {
     if(str.charAt(i) != " ")
     {
       strReturn += str.charAt(i);
     }
   }

   return strReturn;
 }
 
/*
 *  Y2k sicheres Datum liefern
 */
 function getY2kDate()
 {
   var strReturn = "";
   var d = new Date();
   
   var strDate = addLeadingZero(d.getDate(), 2) + "." + addLeadingZero(d.getMonth() + 1, 2) + "." + getY2kYear(d);
   var strTime = addLeadingZero(d.getHours() , 2) + ":" + addLeadingZero(d.getMinutes() , 2) + ":" + addLeadingZero(d.getSeconds() , 2);
   strReturn = strDate + " " + strTime;
   
   return strReturn;
 }
    
/*
 *  Y2k sichere Jahreszahl
 */
 function getY2kYear(d)
 {
   var y = d.getYear();
   if(y < 1970)
   {
     return y + 1900;
   }
   else
   {
     return y;
   }
 }
 
/*
 *  Fuehrende Nullen einfuegen
 */
 function addLeadingZero(value, nTotalLength)
 {
   value += "";
   while(value.length < nTotalLength) value = "0" + value;
   return value;
 }
 
