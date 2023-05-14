# Likus

Aplikacija Likus::

- Naziv, kratka vizija (stavek, dva), namen informacijske rešitve
    *TO JE ŽIVA KNJIGA AVTORJEV (540), KI NASTAJA 35 LET, Namenjena ja ohranjanju zapisov v elektronski obliki (ne zgolj knjižni)
	
- Predvideni uporabniki in glavne funkcionalnosti po uporabnikih (nujne, opcijske)	
    *KNJIGA JE JAVNA. REGISTRIRANIM AVTORJEM JE OMOGOČENO UREJANJE SVOJIH PODATKOV, ŽIVLJENJEPISA, FOTOGRAFIJ, DODAJANJE DRUGIH DATOTEK, MEDSEBOJNA KOMUNIKACIJA.. (ŠE KAJ PO DOGOVORU).
	
	
- Predvideni uporabniški vmesniki (spletni, namizni, mobilni)
	*ČE PRAV RAZUMEM DOSTOP PREKO SPLETA TUDI S TELEFONOM
	
	
- Tehnološke zahteve in omejitve (opcijsko; jezik, ogrodje, platforma, oblačne storitve…; morda lahko ponudite kakšno svojo platformo, na kateri lahko gradijo dalje)
    *NA SPLETU JE NAREJENA BAZA VSEH ČLANOV IN AVTORJEV V OBLAKU. VMESNIK JE NEPREGLEDEN IN BI LAHKO VSEBOVAL EVIDENCO ČLANARIN,
	
	
- Druge omejitve, morda kakšen diagramček poslovnega procesa, ki bi ga bilo treba informatizirati…	
    *MORDA BI SE LAHKO IZDELALO OKNO PODOBNO KNJIGI KAMOR BI VATOR VNESEL SVOJ TEKST IN BI RAČUNALNIK SAMODEJNO NAREDIL PREDVIDEN PRELOM IZGLED KNJIGE IN POKAZAL ŠTEVILO STRANI GLEDE NA TEKST.
	

- Viri / podobne rešitve / primeri dokumentov / vhodnih podatkov / pričakovani izhodi…
    *IZDELANA JE EXEL TABELA OBJAV PO AVTORJIH IN IZDANIH KNJIGAH, TEKSTI SO ŠIŠRIRANI IN DIGITALIZIRANI (pretvorjeni iz pdf v odt). OBSTAJA SEZNAM AVTORJEV IN SEZNAM ZBORNIKOV.

	*PO KLIKU NA AVTORJA SE PRIKAŽE FOTOGRAFIJA, KRATEK ŽIVLJENJEPIS IN SEZNAM OBJAVLJENIH DEL TER SEVEDA V POVEZAVO Z NASLOVOM ZBORNIKA. LAHKO SE PRIKAŽE ŠE KAKŠNA FOTOGRAFIJA, ROKOPIS, KAKŠEN DRUGI ZAPIS, ČE JE.

    Za uporabo REST API-jev v Strapiju lahko uporabite naslednje končne točke:

        -http://localhost:1337/api/{$pural_ime_tabele}/ - ta končna točka vrne vse podatke iz določene tabele.
        -http://localhost:1337/api/{$pural_ime_tabele}/{$id} - ta končna točka vrne podatke za določenega elementa v tabeli, ki ga identificira ID.
        -Zgornji povezavi vrneta samo enolične vrednosti iz tabele, kar pomeni, da ne vrne povezav z drugimi tabelami ali morfizmi. 
        
        Če želite dobiti vse povezave, lahko uporabite naslednje parametre:
         -Če želite dobiti vse povezane podatke, lahko uporabite http://localhost:1337/api/{$pural_ime_tabele}?populate=*. Uporaba populate=*        vrne vse povezane podatke za želeno poizvedbo.

         -Če želite dobiti samo določeno povezavo, na primer samo povezavo na slike, uporabite populate=image. To bo vrnilo samo povezavo na slike. 