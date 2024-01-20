import { createStore } from 'vuex';

export default new createStore({
    state: {
        layout: 'app',
        dark_mode: '',
        layout_style: 'full',

    },
    mutations: {
        setLayout(state, payload) {
            state.layout = payload;
        },


        toggleDarkMode(state, value) {
            value = value || 'light';
            localStorage.setItem('dark_mode', value);
            state.dark_mode = value;
            if (value == 'light') {
                state.is_dark_mode = false;
            } else if (value == 'dark') {
                state.is_dark_mode = true;
            } else if (value == 'system') {
                if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    state.is_dark_mode = true;
                } else {
                    state.is_dark_mode = false;
                }
            }

            if (state.is_dark_mode) {
                document.querySelector('body').classList.add('dark');
            } else {
                document.querySelector('body').classList.remove('dark');
            }
        },

        toggleLayoutStyle(state, value) {
            //boxed-layout|large-boxed-layout|full
            value = value || '';
            localStorage.setItem('layout_style', value);
            state.layout_style = value;
        },
    },
    getters: {
        layout(state) {
            return state.layout;
        },
        cartCount(state) {
            return state.cartCount;
        },
    },
    actions: {},
    modules: {},
});
