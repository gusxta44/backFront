export async function addRoom(form) {
    const formData = new FormData(form);
    const typeAccept = ['image/jpeg', 'image/png'];
    const inputFotos = form.querySelector('#formFileMultiple');
    const imgs = inputFotos.files;
    for (let i = 0; i < imgs.length; i++) {
        if(!typeAccept.includes(imgs[i].type)) {
            throw new Error(`Arquivo "${imgs[i].name}" não é suportado.
            Selecione um arquivo JPG ou PNG`);
        }}
    const url = `api/rooms`;
    const response = await fetch(url, {
        method: "POST",
        body: formData
    });
    // Interpreta a resposta como JSON
    let result = null;
    try {
        result = await response.json();
    }
    catch {
        // Se não for JSON válido, result permanece null
        result = null; }
    if(!response.ok) {
        throw new Error(`Erro ao enviar requisição: ${response.status}`);
    }
    return result; }   

/* Listar os quartos disponíveis de acordo com inicio, fim e qtd */
export async function listAvailableRoomsRequest({inicio, fim, capacidade}){
    const params = new URLSearchParams();
    if (inicio) params.set("inicio", inicio);
    if (fim) params.set("fim", fim);
    if (capacidade !== null && capacidade !== "") params.set("capacidade", String(capacidade));

    const url = `api/rooms/disponiveis?${params.toString()}`;
    const response = await fetch(url, {
        method: "GET",
        headers: {
            "Accept": "application/json",
        },
        credentials: "same-origin"
    });
    let data = null;
    try {
        data = await response.json();
    }
    catch {
        data = null;
    }
    if (!response.ok) {
        const msg = data?.message || "Falha ao buscar quartos disponíveis!";
        throw new Error(msg);
    }
    const quartos = Array.isArray(data?.quartos_disponiveis) ? data.quartos_disponiveis: [];
    console.log(quartos);
    return quartos;
}
    export async function createcadRoom(nome, numero, qnt_cama_casal, qnt_cama_solteiro, preco, disponivel) {

        const dados = {
            nome, 
            numero, 
            qnt_cama_casal,
            qnt_cama_solteiro,
            preco, 
            disponivel
        };

       const response = await fetch("api/rooms", {
            method: "POST",
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json"
            },
            body: JSON.stringify(dados),
            credentials: "same-origin"
        });
        let data = null;

        try {
            data = await response.json();
        } catch (error) {}

        if (!response.ok) {
            const message = data?.message || `Erro ${response.status}: Falha ao criar o quarto.`;
            return { 
                ok: false, 
                data: null, 
                message 
            };
        }

        return {
            ok: true,
            data: data, 
            message: data?.message || "Quarto criado com sucesso."
        };
}