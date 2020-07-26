let modal = {
    toggle: (id) => {
        let e = document.querySelector(`.m_${id}`);
        if (!e.classList.contains('m_visible')) modal.open(id)
        else modal.close(id)
    },
    close: (id) => {
        let e = document.querySelector(`.m_${id}`);

        e.classList.remove('m_visible');
        e.classList.add('m_hidden');

        document.querySelector('.modalBG').style.display = "none";
    },
    open: (id) => {
        let e = document.querySelector(`.m_${id}`);

        e.classList.remove('m_temp_hidden');

        e.classList.remove('m_hidden');
        e.classList.add('m_visible');

        document.querySelector('.modalBG').style.display = "";
    },
    closeAll: () => {
        let modals = ['contact', 'info', 'news'];

        for (i of modals) modal.close(i);
    }
}

document.querySelector('.modalBG').style.display = "none";
// e.style.display = "";
// document.querySelector('.modalBG').style.display = "";