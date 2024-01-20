<template>
	<sidebar-menu :menu="menu" @update:collapsed="onToggleCollapse" v-model:collapsed="collapsed" :theme="menutheme"
		:show-one-child="true">
		<template v-slot:header>
			<v-container class="align-self-center side-header" color="white" contain>
				<router-link to="/admin" tag="span" style="cursor: pointer">
					<v-img src='/images/logo.png' max-width="150"></v-img>
				</router-link>

			</v-container>

		</template>
	</sidebar-menu>

	<v-app :theme="theme" id="main" :class="{ 'collapsed': collapsed }">
		<v-header>
			<Header></Header>
		</v-header>
		<v-main>
			<v-container class="fill-height admin_body_container">

				<router-view></router-view>

			</v-container>
		</v-main>
		<v-footer>

		</v-footer>
	</v-app>
</template>

<script setup>
import Auth from '@/auth.js';
import Header from '@/admin/Header.vue';
import Footer from '@/admin/Footer.vue';
</script>

<script>
import { ref } from 'vue';
const theme = ref('light');
export default {
	mounted() {
		theme.value = window.localStorage.getItem('theme_mode');
		if (theme.value == 'light')
			this.menutheme = 'white-theme';
		else
			this.menutheme = '';
	},
	data() {
		return {
			collapsed: false,
			menutheme: "white-theme",
			isOnMobile: false,
			menu: [
				{
					hiddenOnCollapse: true,
				},
				{
					href: '/admin',
					title: 'Dashboard',
					icon: 'fa-solid fa-bars'
				},
				{
					title: 'Settings',
					icon: 'fa-solid fa-gears',
					child: [
						{
							href: '/admin/users',
							title: 'Users Management',
							icon: 'fa-solid fa-users'
						},
					]
				},
			],
			loggedUser: Auth.user
		}
	},
	methods: {
		themeSwitch() {
			theme.value = theme.value === 'light' ? 'dark' : 'light';

			this.menutheme = this.menutheme === 'white-theme' ? '' : 'white-theme';

			window.localStorage.setItem('theme_mode', theme.value);


		},
		onToggleCollapse(collapsed) {
			this.collapsed = collapsed;
		},
		logout() {
			this.axios.post('/api/logout')
				.then(({ data }) => {
					Auth.logout();
					window.location.href = "/login";
				})
				.catch((error) => {
					console.log(error);
				});
		}
	}
}
</script>
<style>
#main {
	padding-left: 290px;
	-webkit-transition: .3s ease;
	transition: .3s ease;
}

#main.collapsed,
#main.onmobile {
	padding-left: 65px;
}

.v-footer {
	flex: initial;
}
</style>
