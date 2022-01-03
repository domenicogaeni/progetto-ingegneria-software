# Use-case diagram @Fabio Palazzi

Per modellare i casi d’uso, ovvero le funzionalità degli attori nel sistema, abbiamo modellato uno use-case diagram.

![Untitled](assets/Use-case%20diagram%20@Fabio%20Palazzi%207636d46f891d46bd9107fa992e7f222a/Untitled.png)

L’attore principale è il cliente che è esteso sia dall'attore compratore che venditore, infatti un cliente (che venditore o compratore sia), una volta registrato può sia vendere che comprare libri. Non abbiamo quindi funzionalità specifiche ma solo comuni ad entrambi i ruoli.

Un cliente ha molte funzionalità che possiamo dividere in base al contesto in cui si ubicano.

Abbiamo infatti un primo gruppo che comprende : **Show History, Buy Book, Insert Sale Announcement, Review Seller, Review Book, Search Book** che possono essere effettuate solo da clienti loggati. In particolare, questi *Use Case* includono **Sign In**, proprio per il motivo specificato sopra. Lo Use Case **Buy Book** include **Manage Payment,** infatti ****per comprare un libro si deve pagare il venditore. Inoltre rappresentiamo solamente il **Payment Service** ovvero il sistema che si occupa di gestire i pagamenti.

Il secondo tipo di funzionalità è relativo alle azioni eseguibili dal cliente per usufruire dei servizi specificati sopra. Tra esse abbiamo **Sign in, Sign Up, Recovery Password.** Entrambe includono il caso d’uso **Verify** in quanto per essere eseguite con successo necessitano una verifica di alcuni parametri.

Il terzo e ultimo tipo è **Verify** ovvero si occupa di verificare la correttezza dei dati inseriti nelle funzionalità del secondo tipo e inoltre, qualora fosse richiesto, di inviare email (**Send Email)** o SMS (**Send SMS)** al fine di implementare la cosiddetta *doppia autenticazione* gestita tramite gli attori: **SMTP Service**  e **OTP SMS Service***.*
