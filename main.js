function toggleMenu(event){
    const link = event.currentTarget;
    const submenu = link.nextElementSibling;
    const chevronDown = link.querySelector('.bx-chevron-down');

    if(submenu.classList.contains('show')){
        submenu.classList.remove('show');
        chevronDown.style.transform = 'rotate(0deg)';
    }else{
        submenu.classList.add('show');
        chevronDown.style.transform = 'rotate(180deg)';
    }
}

const menuToggle = document.querySelector('.menu-toggle input');
const aside = document.querySelector('aside');
const header = document.querySelector('.header');
const main = document.querySelector('main');
menuToggle.addEventListener('click', () => {
    aside.classList.toggle('slide');
    header.classList.toggle('slide');
    main.classList.toggle('slide');
});

document.querySelector('.btn').onclick = function (e) {
    const select = document.querySelector('select[name="class"]');
    const table = document.querySelector('.cont-table');

    if (select.value) {
        e.preventDefault(); // Hindari reload jika pakai JS
        table.style.display = 'block';
    } else {
        e.preventDefault();
        alert('Pilih kelas terlebih dahulu!');
    }
};

semesterInputs.forEach(input => {
    input.addEventListener('input', () => {
        let total = 0;
        let count = 0;

        semesterInputs.forEach(sInput => {
            const val = parseFloat(sInput.value.replace(',', '.')); // tetap konversi di sini
            if (!isNaN(val)) {
                total += val;
                count++;
            }
        });

        avgInput.value = count > 0 ? (total / count).toFixed(2).replace('.', ',') : '';
    });
});


