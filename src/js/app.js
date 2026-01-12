const steps = document.querySelectorAll('.step');

function showSteps() {
    const triggerBottom = window.innerHeight * 0.75;

    steps.forEach(step => {
        const boxTop = step.getBoundingClientRect().top;

        if (boxTop < triggerBottom) {
            step.classList.add('visible');
        }
    });
}

window.addEventListener('scroll', showSteps);
showSteps();
