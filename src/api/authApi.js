export async function loginRequest(email, senha){
    const response = await fetch("/api/login.php", {
        method: "POST", 
        headers: {
            "Accept": "application/json",
            "Content-Type": "aplication/x-www-form-urlencoded;charset=UTF-8"
        },
        body: new URLSearchParams({email, senha}).toString(),

        /* URL da requesição é a mesma da origem do front (mesmo protocolo 
        http/mesmo doimini - local/mesma porta 80 do servidor web Apache)
        Back: https:/localhost/MeuSite/ap/login.php
        */
        credentials: "same-origin"
    });
    // interpetrar a resposta como JSON

    let data = null;
    try{
        data = await response.json();
    } 
    catch {
        // Se não for JSON válido, data  permanece null
        data = null;
    }

    return {
        ok: true,
        user: data.user  ?? null,
        raw: data 
    };
}
