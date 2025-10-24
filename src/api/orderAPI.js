export async function finishedOrder(items) {
    const url = "api/orders/reservation";
    const body = {
        /*Por enquanto, para conseguirmos testar, o cliente_id será setado no código,
        amanhã o Jeff tratará o token que valida o cliente no back-end, de modo que o envio
        do token já será o suficiente para definir a quem pertence o pedido*/
        cliente_id: 7,

        /*Por enquanto todo pagamento será via pix, até termos um
        front para usuário setar forma de pagamento que desejar */
        pagamento: "pix",
        quartos: items.map(it => (
            {
                id: it.roomId,
                inicio: it.checkIn,
                fim: it.checkOut
            }
        ))
    };
    const res = await fetch(url, {
        method: "POST",
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        credentials: "same-origin",
        body: JSON.stringify(body)
    });
    let data = null;
    try {
        //Retorno em json() da requisição armazenado em data
        data = await res.json();
    }
    catch { data = null; }
    if (!data) {
        const message = `Erro ao enviar pedido: ${res.status}`;
        return {ok: false, raw: data, message}; }
    return {
        ok: true,
        raw: data
    }
}