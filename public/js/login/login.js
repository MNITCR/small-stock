$(document).ready(function () {
    const toggleButton = $("#toggle-mode");
    const container = $(".container-fluid");
    const cards = $("#dark-mode-card");
    const modeIcon = $("#mode-icon");

    // Check if user preference is stored in localStorage
    const isDarkMode = localStorage.getItem("darkMode") === "true";
    const iconState = localStorage.getItem("iconState"); // Get the icon state

    // Set initial mode based on localStorage or system preference
    if (isDarkMode) {
        container.addClass("dark-mode");
        cards.addClass("bg-dark");
    } else {
        container.addClass("light-mode");
        cards.addClass("bg-white");
    }

    // Set the initial icon state based on localStorage
    if (iconState === "sun") {
        modeIcon.addClass("fa-sun");
    } else {
        modeIcon.addClass("fa-moon");
    }

    toggleButton.on("click", function () {
        if (container.hasClass("light-mode")) {
            container.removeClass("light-mode").addClass("dark-mode");
            cards.removeClass("bg-white").addClass("bg-dark");
            modeIcon.removeClass("fa-moon").addClass("fa-sun");

            // Store the dark mode preference and icon state in localStorage
            localStorage.setItem("darkMode", "true");
            localStorage.setItem("iconState", "sun");
        } else {
            container.removeClass("dark-mode").addClass("light-mode");
            cards.removeClass("bg-dark").addClass("bg-white");
            modeIcon.removeClass("fa-sun").addClass("fa-moon");

            // Store the light mode preference and icon state in localStorage
            localStorage.setItem("darkMode", "false");
            localStorage.setItem("iconState", "moon");
        }
    });
});

$(document).ready(function() {
    const rememberCheckbox = $('#remember');
    const emailInput = $('#email');
    const passwordInput = $('#password');

    // Check if "Remember Me" is checked and restore saved values from cookies
    if (rememberCheckbox.is(':checked')) {
      const savedEmail = getCookie('remembered_email');
      const savedPassword = getCookie('remembered_password');

      if (savedEmail) {
        emailInput.val(savedEmail);
      }

      if (savedPassword) {
        passwordInput.val(savedPassword);
      }
    }

    // Save email and password to cookies when "Remember Me" is checked
    rememberCheckbox.on('change', function() {
      if (rememberCheckbox.is(':checked')) {
        setCookie('remembered_email', emailInput.val(), 30); // 30 days expiration
        setCookie('remembered_password', passwordInput.val(), 30);
      } else {
        deleteCookie('remembered_email');
        deleteCookie('remembered_password');
      }
    });

    // Cookie functions
    function setCookie(name, value, days) {
      const expires = new Date();
      expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
      document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
    }

    function getCookie(name) {
      const match = document.cookie.match(new RegExp(`${name}=([^;]+)`));
      return match ? match[1] : null;
    }

    function deleteCookie(name) {
      document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/`;
    }
  });
