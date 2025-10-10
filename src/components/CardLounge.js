export default function CardLounge(cardLoungeItem, index = 0) {
    const {
        path,
        title,
        text
    } = cardLoungeItem || {}
 
    const CardLounge = document.createElement('div');
    CardLounge.innerHTML =
    `<div class="card" style="width: 18rem; height: 17rem">
        <img src="publics/assets/img/${path}"style="height: 50px" class="card-img-top" alt="...">
        <div class="btn-group dropup">
            <button type="button" class="btn" data-bs-toggle="dropdown"
                aria-expanded="false style=border: none";>
                    <img src="publics/assets/img/caret-up-fill.svg" width: "20" height: "20">
                <h3 class="card-text" style="font-size: 1rem; font-weight: 700;">${title}</h3>
            </button>
            <ul class="dropdown-menu style="border-radius: 0.375rem 0.375rem 0 0;">
                <p class="card-text" style="${text}</p>
            </ul>
        </div>
    </div>`
    return CardLounge;
}
 
 