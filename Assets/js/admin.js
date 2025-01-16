document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.nav-links li[data-tab]');
    const contentSections = document.querySelectorAll('.content-section');

    function switchTab(tabId) {
        navLinks.forEach(link => link.classList.remove('active'));
        contentSections.forEach(section => section.classList.remove('active'));

        const activeLink = document.querySelector(`[data-tab="${tabId}"]`);
        const activeSection = document.getElementById(tabId);

        if (activeLink && activeSection) {
            activeLink.classList.add('active');
            activeSection.classList.add('active');
        }
    }

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            const tabId = link.getAttribute('data-tab');
            switchTab(tabId);
        });
    });




});

const modal = document.getElementById('categoryModal');
const openModalBtn = document.querySelector('.primary-btn'); 
const closeModalBtn = document.getElementById('closeModal');
const categoryForm = document.getElementById('categoryForm');

openModalBtn.addEventListener('click', () => {
    modal.classList.add('active');
});

closeModalBtn.addEventListener('click', () => {
    modal.classList.remove('active');
});

modal.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.classList.remove('active');
    }
});

const tagModal = document.getElementById('tagModal');
const openTagModalBtn = document.getElementById('addTagBtn');
const closeTagModalBtn = document.getElementById('closeTagModal');
const tagForm = document.getElementById('tagForm');


if (openTagModalBtn) {
    openTagModalBtn.addEventListener('click', () => {
        tagModal.classList.add('active');
    });
}

if (closeTagModalBtn) {
    closeTagModalBtn.addEventListener('click', () => {
        tagModal.classList.remove('active');
    });
}

if (tagModal) {
    tagModal.addEventListener('click', (e) => {
        if (e.target === tagModal) {
            tagModal.classList.remove('active');
        }
    });
}
tagForm.addEventListener("input", (e) => {
    let input = e.target.value
    const lastChar = input.at(-1) 
    if (!/[a-zA-Z,.1-9]/.test(lastChar)) {
        e.target.value = input.slice(0, -1)
    }
})
// tagForm.addEventListener("input" , (e)=>{
//     const input = e.target.value
//     const lastChar = input.charAt(-1)
//     if(lastChar != /[a-zA-Z]/ || lastChar != ","){
//      input = input.slice(0,-1)
//     }
//  })







