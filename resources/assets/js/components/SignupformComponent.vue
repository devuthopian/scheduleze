<template>
	<div class="simple-root">
		<div class="form-group">
				<input type="text" name="email" v-validate="'required|email'" :class="{'input': true, 'is-danger': errors.has('email') }" placeholder="Business Email" />
				<i v-show="errors.has('email')" class="fa fa-warning"></i>
                <span v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</span>
				<input type="text" name="username" v-validate="'required|alpha'" :class="{'input': true, 'is-danger': errors.has('username')}" placeholder="Username">
				<i v-show="errors.has('username')" class="fa fa-warning"></i>
                <span v-show="errors.has('username')" class="help is-danger">{{ errors.first('username') }}</span>
			</div>
		</div>
	</div>
</template>