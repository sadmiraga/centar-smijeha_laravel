Spletna stran ima 5 glavnih stavkov

1.HOME 
	Na pocetnoj strani se ispisuju svi vicevi koji se nalaze u bazi podataka uz broj lajkova.
	Ce je uporabnik prijavljen tudi ima moznost funckije LIKE al pa UNLIKE odvisno od tega
	ce je že lajkal tisto šalo.

2. NOVI VIC / POSALJITE NOVI VIC
	Tukaj lahko posaljete svojo šal.
	Šal lahko pošiljejo gosti kot uporabnici.
	Ce šal poiskusite poslati kot gost morali boste ispolniti reCaptcha virifikaciju.
	že obstaja user sa imenom UNKNOWN kateri je vlasnik vseh šal katere pošljejo gosti
	Vsaka šala mora biti odobrena od strane head admina al pa admina, in potem je ostali lahko vidijo
	razen še je šala posala od strane head admina
	Ce Šalo šalje head admin šala je automatski odobrena
	Tudi uporabnici prej kot posljejo šalo morajo odabrati v katero kategorijo šala spada 

3.MOJ PROFIL
	
	VSI UPORABNICI:
		Na tistoj strani se ispišejo vse šale katere je ta uporabnik poslal ne glede na
		to ce je odobren ali ne
		uporabnici lahko uredijo šalo torej lahko spremenijo text in kategorijo šale
		ko spremenijo nekaj v šala, šala spet mora biti odobrena razen ce je head admin
		spremenil šalo
		uporabnici tudi lahko izbrišejo šalo katero so poslali
		
		UREDI PROFIL:
			uporabnici lahko spremeijo geslo, katero ne more biti isto kot prejšnjo.
			uporabnici lahko spremenijo elektronski naslov 
			uporabnici lahko spremeijo uporabnisko ime 
	
	ADMIN:
		navadni admin poleg vsega tega ima še Admin Panel

			ADMIN PANEL:
				navadni admin lahko doda novo kategorijo 
				tudi navadni admin ima 'ODOBRI VICEVE' opcijo

				ODOBRI VICEVE:
					Na tistoj strani adminu se ispisejo vsi podatki šale
					katera še ni odobrena, torej ispise mu se ime Autora kateri je to šal poslal 
					text vica kateri je uporabnik napisal in kategorijo kateru je uporabnik odabral ko je poslal šalo
					admin lahko ODOBRI al pa ODBIJE palo

						ODOBRI:
							v podatkovni bazi se samo spremeni atribut šale pod nazivom 'approve', spremeni se na 'yes'
						ODBIJ:
							iz podatkovne baze se izbriše šala
	HEAD ADMIN:
		head admin ima vse možnosti kot ih ima navadni admin ampak ima še eno dodatno možnost, a to je 'UPRAVLJANJE KORISNICIMA'
		
		UPRAVLJANJE KORISNICIMA:
			na toj strani head adminu se ispise
				-ID UPORABNIKA
				-IME UPORABNIKA						
				-EMAIL UPORABNIKA					
				-ULOGO UPORABNIKA
			tudi head admin lahko izbriše uporabnika torej ga izbriše iz podatkovne baze 
			tudi lahko spremeni njegovo ulogo, (korisnik, admin, head admin)
4.Kategorije
	Na tistoj strani se ispišejo vse kategorije, cist na vrhu se nalazi kategorija pod nazivom 'TOP VICEVI'
	klik na kategorijo preusmeri na novo stran na kateroj ispise vse viceve iz tiste kategorije 
		TOP VICEVI:
			na tistoj strani se ispisejo vsi vicevi kateri so lajkani poredani od onog sa najvec lajkov do onog ki ima najmanj lajkov 
5. LOGOUT/PRIJAVA/REGISTER
		

		
