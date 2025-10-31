import Navbar from "../components/Navbar.js";
import { clearHotel_Cart, getCart, getTotalItems } from "../../store/CartStore.js";
//Importar componente Footer

export default function renderCartPage() {
    //Navbar
    const nav = document.getElementById('navbar');
    nav.innerHTML = '';
    const navbar = Navbar();
    nav.appendChild(navbar);

    //Root (corpo da página)
    const divRoot = document.getElementById('root');
    divRoot.innerHTML = '';

    const reservations = getCart();
    console.log(reservations);

    const total = getTotalItems();
    console.log(total);

    const container = document.createElement('div');
    container.className = "container my-4";

    const header = document.createElement('div');
    header.className = "d-flex align-items-center justify-content-between mb-3";

    //Cabeçalho da tabela
    header.innerHTML =
    `
        <h3 class="mb-0">Reservas</h3>
        <div>
            <button id="btnClear" class="btn btn-outline-danger btn-sm">Limpar carrinho</button>
        </div>
    `
    //Tabela
    const table = document.createElement('div');
    if (reservations.length === 0) {
        table.innerHTML = `<div class="alert alert-info">Nenhuma reserva no carrinho.</div>`
    }
    else {
        table.innerHTML =
        `
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-success">
                        <!-- Colunas da tabelas -->
                        <tr>
                            <th>Nome do quarto</th>
                            <th>Data de check-in</th>
                            <th>Data de check-out</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${reservations.map(item =>
                            `
                            <tr>
                                <td>${item.nome}</td>
                                <td>${item.checkIn}</td>
                                <td>${item.checkOut}</td>
                                <td>R$ ${item.subtotal}</td>
                            </tr>
                            `).join("")}
                    </tbody>
                    <tfoot>
                            <tr>
                                <th><th>
                                <th>
                                    <h3 style="font-size: 19px;">Total: R$ ${total}</h3>
                                </th>
                                <th>
                                    <button id="btnFinalizar" class="btn btn-outline-success btn-sm"> Finalizar compra</button>
                                </th>
                            </tr>
                    </tfoot>
                </table>    
            </div>
        `
    }    
    container.appendChild(header);
    container.appendChild(table);
    divRoot.appendChild(container);

    const btnClear = document.getElementById("btnClear");
        if (btnClear) {
            btnClear.addEventListener("click", () => {
                clearHotel_Cart();
                renderCartPage();
            });
        }
}