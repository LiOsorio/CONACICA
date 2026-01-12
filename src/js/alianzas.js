  // Seleccionamos los elementos
  const marquee = document.querySelector('.logo-marquee');
  const track = document.querySelector('.logo-track');

  // Solo si existen en el DOM
  if (marquee && track) {
    // Duplicamos automáticamente los logos
    track.innerHTML += track.innerHTML;

    
  }


