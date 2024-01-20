<template>
	<v-container height="75px">
		<v-toolbar class="">
			<v-toolbar-title class="hidden-sm-and-down font-weight-light" v-text="$route.name" />
			<v-spacer />
			<v-menu bottom left offset-y origin="top right" transition="scale-transition">
				<template v-slot:activator="{ attrs, on }">
					<v-btn @click="themeSwitch" class="ml-2" min-width="0" primary v-on="on">
						<v-icon>
							<template v-if="theme === 'light'">mdi-weather-sunny</template>
							<template
								v-else>mdi-weather-night</template>
							</v-icon>
							</v-btn>
				</template>
			</v-menu>
			<v-menu open-on-hover>
				<template v-slot:activator="{ props }">
					<v-btn color="primary" v-bind="props" class="ma-0">
						<v-icon color="orange darken-2">mdi-account</v-icon>
					</v-btn>
				</template>
				<v-list>
					<v-list-item prepend-icon="mdi-account" title="Account Settings" link
						@click="$router.push('/admin/account/settings')"></v-list-item>
					<v-list-item prepend-icon="mdi-logout" @click="logout" title="Logout"></v-list-item>
				</v-list>
			</v-menu>
		</v-toolbar>
	</v-container>
</template>
<script setup>
import Auth from "@/auth.js";
</script>
<script>
import { ref } from "vue";
const theme = ref("light");
export default {
	mounted() {
		theme.value = window.localStorage.getItem("theme_mode");
		if (theme.value == "light") this.menutheme = "white-theme";
		else this.menutheme = "";

		this.collapsed = window.localStorage.getItem("collapsed");
	},

	data() {
		return {
			menutheme: "",
			isOnMobile: false,
			showForm: false,
		};
	},
	methods: {
		themeSwitch() {
			theme.value = theme.value === "light" ? "dark" : "light";
			this.menutheme =
				this.menutheme === "white-theme" ? "" : "white-theme";
			this.$emit("update:counter", this.childCounter);
			window.localStorage.setItem("theme_mode", theme.value);
			window.location.reload();
		},

		logout() {
			this.axios
				.post("/api/logout")
				.then(({ data }) => {
					Auth.logout();
					window.location.href = "/login";
				})
				.catch((error) => {
					console.log(error);
				});
		},
		accountSettings() {
			this.showForm = true;
		},
	},
};
</script>
