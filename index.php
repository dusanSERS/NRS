<!DOCTYPE html>
<html lang="en" >
  <head>
    <meta charset="utf-8">
    <title>Izbira vsebine</title>
	<link rel="stylesheet" type="text/css" href="css/stil2.css">
    <script>
		var vsebine = ["Linux","Laravel","Android", "JavaScript"];
		var ze_vstavljeni = [];
	  
		// isce element v polju. ce najde vrne true, v nasprotnem primeru false
		function nasel(polje,element)
		{	var i = 0;
			for( i = 0 ; i < polje.length ; i++)
			{
				if( polje[i] == element)
				{
					return true;
				}
				
				
			}
			return false;
			
		}
		
		// napolni combo, ampak ne že izbrane
		function codeAddress(stevilo,ze_izbr) 
		{
			//var stevilo = 1;
			/* Selects all element with ID parent */
			//var kaj = "select" + stevilo;
			var parent = document.getElementById("select" + stevilo);
			
			/* Selects all childs of parent having <span> as the element */
			var child = parent.querySelectorAll("option");
			
			var ze_vstavljeni = [];
			for( i = 0; i < 5-stevilo ; i++)
			{
				while(true)
				{
					var r = ( Math.random().toFixed(1) *10) % (5-stevilo);			
					if( nasel(ze_vstavljeni, r ) == false )
					{
						ze_vstavljeni.push( r );
						child[i].innerHTML  = vsebine[r]; 
						break;
					}
				}
			}
		}
		
		
		var izbira_stevilo = 4;
		
		function Prikazi(skrij_st, pokazi_st)
		{
			var pokazi = "div" + pokazi_st;
			var skrij = "select" + skrij_st ;
			var ustvari = "div" + skrij_st;
			var gumb = "button" + skrij_st;

			// prikaze izbrano v novem textboxu
			var izbrano = document.getElementById(skrij);
			var izbraniText = izbrano.options[izbrano.selectedIndex].text;
			
			vsebine.splice(vsebine.indexOf(izbraniText),1);	// odstrani ze izbrani element

			//odstrani combobox in button
			var konec = document.getElementById(skrij);
			konec.parentNode.removeChild(konec);

			var konec = document.getElementById(gumb);
			konec.parentNode.removeChild(konec);

			// ustvari nov element in ga daj v div
			var input = document.createElement('input');
			input.setAttribute("id", "izbira" + skrij_st );
			input.setAttribute("type","text");
			input.setAttribute("value",izbraniText);
			input.setAttribute("readonly","true");
			input.setAttribute("name","izbira" + skrij_st);
			document.getElementById("div" + skrij_st).appendChild(input);

			// prikazi nov div
			if(pokazi_st != 0)  // če ni zadnji
			{
			  document.getElementById(pokazi).style.display = "block";
			}
			else
			{
			  document.getElementById("potrdi").style.display = "block";
			}

			//napolni nov div
			codeAddress(skrij_st+1);
	
			return false;
		}
    </script>
  </head>

  <body onload="codeAddress(1)">
	<div class="form-style-3" >
    <form class="form-style-4" action="izbrano.php" method="post">
		<fieldset>
			<legend>Osebni podatki</legend>
			
				<label for="ime">
					<span>Ime<span class="required">*</span></span>
					<input type="text" name="ime" id="ime" class="input-field" />
				</label>
			
			
				<label for="priimek">
					<span>Priimek<span class="required">*</span></span>
					<input type="text" name="priimek" id="priimek" class="input-field" />
				</label>
			
				<label for="razred" >
					<span>Razred<span class="required">*</span></span>
					<select id="razred" name="razred" class="select-field">
						<option value="R4A">R4A</option>
						<option value="R4B">R4B</option>
					</select>
				</label>
				
				<label for="email">
					<span>Email<span class="required">*</span></span>
					<input type="email" name="email" id="email" class="input-field" />
				</label>
				
				<label for="telefon">
					<span>Telefon (mobi)<span class="required">*</span></span>
					<input type="text" name="telefon" id="telefon" class="input-field" />
				</label>
		</fieldset>
		
		<fieldset>
			<legend>Izbira</legend>
			
			<div id="div1" style="display:block">
				<label for="select1">
					<span>Prva izbira</span>
					<select id="select1">
						<option value="izbira1"></option>
						<option value="izbira2"></option>
						<option value="izbira3"></option>
						<option value="izbira4"></option>
					</select>
					<input type="button" id="button1" onclick="Prikazi(1,2);return false;" value="Izberi" />
				</label>
			</div>

			<div id="div2" style="display:none">
				<label for="select2">
					<span>Druga izbira</span>
					<select id="select2">
					  <option value="izbira1"></option>
					  <option value="izbira2"></option>
					  <option value="izbira3"></option>
					</select>
					<input type="button"  id="button2" onclick="Prikazi(2,3);return false;" value="Izberi" />
				</label>
			</div>

			<div id="div3" style="display:none">
				<label for="select3">
					<span>Tretji izbira</span>
					<select id="select3">
					  <option value="izbira1"></option>
					  <option value="izbira2"></option>
					  
					</select>
					<input type="button"  id="button3"  onclick="Prikazi(3,4);return false;" value="Izberi"/>
				</label>
			</div>

			<div id="div4" style="display:none">
				<label for="select4">
					<span>Četrta izbira</span>
					<select id="select4">
					  <option value="izbira1"></option>
					</select>
					<input type="button"  id="button4"  onclick="Prikazi(4,0);return false;" value="Izberi" />
				</label>
			</div>
		</fieldset>
		
		<div id="potrdi" style="display:none">
			<input id="konec" type="submit" value="Oddaj" />
		</div>
    </form>
	</div>

  </body>
</html>
