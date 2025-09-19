export default function RoomCard(index) {
    const card = document.createElement('div');
    card.className = "cardContainer";
    card.innerHTML =
    //Bootstrap
    `
    <div class="card" style="width: 18rem;">
        <div id="carouselExampleIndicators-${index}" class="carousel slide">
            <div class="carousel-indicators">
                <button visually-hiddentype="button" data-bs-target="#carouselExampleIndicators-${index}" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators-${index}" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators-${index}" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
  
            <div class="carousel-inner shadow">
                <div class="carousel-item active">
                    <img src="public/assets/images/imgpremium.jpg" class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="public/assets/images/imgh3.jpg" class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="public/assets/images/img.jpg" class="d-block w-100" alt="...">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators-${index}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon visually-hidden" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
 
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators-${index}" data-bs-slide="next">
                <span class="carousel-control-next-icon visually-hidden" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>
        
        <div class="card-body">
            <h5 class="card-title">Quarto Premium</h5>
            <p class="card-text">Descrição do quarto: Lorem ipsum dolor sit amet consectetur
             adipisicing elit. Officia, harum libero, ratione, nostrum iusto dicta.</p>
            <a href="#" class="btn btn-primary">Reservar</a>
        </div>
    </div>

    `;
    return card;
}