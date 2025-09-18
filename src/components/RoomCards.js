export default function RoomCards(){
    const card = document.createElement('div');
    card.innerHTML = 
    
    `
    <div class="card" style="width: 18rem;">
        <div id="carouselExampleIndicators-RoomCard" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators-RoomCard" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators-RoomCard" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators-RoomCard" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
 
            <div class="carousel-inner shadow">
 
            <div class="carousel-item active">
            <img src="public/assets/images/imgpremium.jpg" class="d-block w-100" alt="...">
            </div>
       
            <div class="carousel-item">
            <img src="public/assets/images/img.jpg" class="d-block w-100" alt="...">
            </div>
       
            <div class="carousel-item">
            <img src="public/assets/images/imgh3.jpg" class="d-block w-100" alt="...">
            </div>
       
        </div>
       
    
    </div>
            <div class="card-body">
            <h5 class="card-title">Quarto Premium</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            
    </div>
    `;
 
    return card;
 
}
 