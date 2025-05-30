<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="8000">
            <img src="includes/photos/pngtree-jesus-standing-on-top-of-a-cloud-with-the-sun-shining-image_2902589.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-block text-white bg-dark bg-opacity-50 rounded p-2">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="5000">
            <img src="includes/photos/—Pngtree—jesus standing on the mountain_3170007.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-block text-white bg-dark bg-opacity-50 rounded p-2">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="5000">
            <img src="includes/photos/—Pngtree—the cross on hill with_15784505.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-block text-white bg-dark bg-opacity-50 rounded p-2">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<script>
    const carousel = document.querySelector('#carouselExampleAutoplaying .carousel-inner');
    const outerCarousel = document.querySelector('#carouselExampleAutoplaying');
    let startX = 0;
    let currentX = 0;
    let diffX = 0;
    let isDragging = false;

    outerCarousel.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        isDragging = true;
        carousel.style.transition = 'none';
    });

    outerCarousel.addEventListener('touchmove', (e) => {
        if (!isDragging) return;
        currentX = e.touches[0].clientX;
        diffX = currentX - startX;

        carousel.style.transform = `translateX(${diffX}px)`;
    });

    outerCarousel.addEventListener('touchend', () => {
        if (!isDragging) return;
        isDragging = false;

        carousel.style.transition = 'transform 0.3s ease';

        const threshold = 50;
        const bsCarousel = bootstrap.Carousel.getInstance(outerCarousel);

        if (diffX > threshold) {
            carousel.style.transform = `translateX(100%)`;
            setTimeout(() => {
                bsCarousel.prev();
                carousel.style.transform = '';
            }, 300);
        } else if (diffX < -threshold) {
            carousel.style.transform = `translateX(-100%)`;
            setTimeout(() => {
                bsCarousel.next();
                carousel.style.transform = '';
            }, 300);
        } else {
            carousel.style.transform = 'translateX(0)';
        }
    });
</script>
