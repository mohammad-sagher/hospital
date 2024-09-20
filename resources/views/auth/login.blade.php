<x-guest-layout>
    <style>
        /* Background Image */
        /* Background Image */
body {
    background-image: url('{{ asset('images/background.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    margin: 0;
    font-family: Arial, sans-serif;
}

/* Centering and Styling the Form Container */
.login-container {
    background-color: rgb(255, 255, 255);
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
    max-width: 800px; /* Increase max-width for better layout */
    margin: 2rem auto;
    margin-top: 5%; /* Adjust margin-top to better center the container */
    display: flex;
    align-items: center;
    justify-content: space-between; /* Align form and image */
    gap: 2rem; /* Space between form and image */
}

/* Form Styling */
form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    flex: 1; /* Allow the form to grow */
}

/* Animated Image Container */
.animated-image-container {
    flex: 1; /* Allow the container to grow */
    display: flex;
    align-items: center;
    justify-content: center;
}

.animated-image {
    width: 100%;
    max-width: 300px; /* Adjust size as needed */
}

/* Input Fields */
input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    font-size: 1rem;
    line-height: 1.5;
    background-color: #ffffff;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 1px #4f46e5;
    outline: none;
}

/* Error Messages */
.input-error {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

/* Button Styling */
button {
    background-color: #4f46e5;
    color: #ffffff;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.375rem;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

button:hover {
    background-color: #4338ca;
    transform: scale(1.02);
}

button:active {
    background-color: #3730a3;
}

/* Links Styling */
a {
    color: #4f46e5;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

a:hover {
    color: #3730a3;
}

/* Labels and Buttons */
.x-input-label,
.x-primary-button {
    font-size: 1.125rem;
    color: #1f2937;
}

.x-input-label {
    margin-bottom: 0.5rem;
}

.x-primary-button {
    background-color: #4f46e5;
    color: #ffffff;
    padding: 0.75rem 1.5rem;
    border-radius: 0.375rem;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.x-primary-button:hover {
    background-color: #4338ca;
    transform: scale(1.02);
}

.x-primary-button:active {
    background-color: #3730a3;
}


/* Animated Image Container */
.animated-image-container {
    flex: 1; /* Allow the container to grow */
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Increase the size of the animated image */
.animated-image {
    width: 100%;
    max-width: 500px; /* Increase the max-width as needed */
    height: auto; /* Maintain aspect ratio */
}


    </style>
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <div class="login-container">
      <form method="POST" action="{{ route('login') }}">
          @csrf

          <!-- Email Address -->
          <div>
              <x-input-label for="email" :value="__('Email')" />
              <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
              <x-input-error :messages="$errors->get('email')" class="mt-2 input-error" />
          </div>

          <!-- Password -->
          <div class="mt-4">
              <x-input-label for="password" :value="__('Password')" />
              <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
              <x-input-error :messages="$errors->get('password')" class="mt-2 input-error" />
          </div>

          <!-- Remember Me -->
          <div class="block mt-4">
              <label for="remember_me" class="inline-flex items-center">
                  <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                  <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
              </label>
          </div>

          <div class="flex items-center justify-end mt-4">
              @if (Route::has('password.request'))
                  <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                      {{ __('Forgot your password?') }}
                  </a>
              @endif

              <x-primary-button class="ms-3">
                  {{ __('Log in') }}
              </x-primary-button>
          </div>
      </form>

      <!-- Animated Image -->
      <div class="animated-image-container">
        <div style="width:100%;height:auto;">
            <img src="https://media.giphy.com/media/g2qe2w5GTzFJkd5Ewm/giphy.gif" alt="Animated Image" class="animated-image" />
        </div>
    </div>
    

      <script>
          document.addEventListener('DOMContentLoaded', function () {
              const animatedImage = document.querySelector('.animated-image');
              
              // Example: Add an animation class after a delay
              setTimeout(() => {
                  animatedImage.classList.add('animate');
              }, 1000);
          });
      </script>

  </div>
</x-guest-layout>
