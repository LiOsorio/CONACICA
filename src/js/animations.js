const observer = new IntersectionObserver(( entries ) => {
    entries.forEach( ( entry ) => {
        if( entry.isIntersecting ){
            console.log(entry.target);
            entry.target.classList.add("animationShow")
        }else{
            entry.target.classList.remove("animationShow")
        }
    })
}, {})

const animationElements = document.querySelectorAll(".animation")
animationElements.forEach(el => observer.observe(el))