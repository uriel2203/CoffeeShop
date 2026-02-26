# Caféra - Premium Iced Coffee & Cold Brew Landing Page

Welcome to the **Caféra** landing page project! This is a modern, responsive, and beautifully animated single-page application built on top of Laravel, utilizing Tailwind CSS for styling and Vanilla JavaScript for smooth scroll animations.

![Caféra Hero Banner](https://images.unsplash.com/photo-1572490122747-3968b75cc699?q=80&w=800&auto=format&fit=crop)

## Features & Design

This project completely replaces the default Laravel welcome view (`welcome.blade.php`) with a custom, high-end "Caféra" landing page designed to highlight premium iced coffee and cold brew products.

*   **Modern Premium Aesthetic**: Utilizes a rich dark brown (`#37261a`) and cream/beige (`#ebd9c8`) color palette to evoke the feeling of high-quality coffee.
*   **Elegant Typography**: Integrates Google Fonts featuring **Playfair Display** (a sophisticated serif) for bold headings and **Inter** (a clean sans-serif) for highly readable body text.
*   **Framer-Like Scroll Animations**: Implements a custom, lightweight Vanilla JavaScript `IntersectionObserver` directly within the blade file. As users scroll, elements smoothly fade in and slide up (using Tailwind `.opacity-0`, `.translate-y-10`, and `.duration-1000` utility classes) to create a premium, engaging experience without relying on heavy third-party animation libraries.
*   **Fully Responsive**: Built with a mobile-first approach using Tailwind CSS. The layout gracefully adapts from mobile devices to large desktop screens, stacking columns on smaller screens and emphasizing the imagery.
*   **High-Quality Imagery**: Integrates beautiful, relevant placeholder images from Unsplash (and Picsum) that match the iced coffee aesthetic.
*   **Comprehensive Sections**:
    *   **Hero**: Bold headline with a dark background and key statistics.
    *   **Features (Brewed to Refresh)**: Highlights product benefits with clean typography and icons.
    *   **Menu (Our Cold Brew Collection)**: Displays product cards with hover effects.
    *   **Process (Crafted the Right Way)**: A split section explaining the brewing methodology.
    *   **Comparison**: A clear "Cold Brew vs Regular Coffee" comparison chart.
    *   **Lifestyle**: Photo grid showing everyday coffee moments.
    *   **Testimonials**: User reviews establishing social proof.
    *   **Newsletter & Footer**: Email subscription call-to-action with member perks.

## Tech Stack

*   **Framework**: [Laravel 11.x](https://laravel.com)
*   **Interactivity (Real-time)**: [Livewire 4.x](https://livewire.laravel.com)
*   **Styling**: [Tailwind CSS 4.0](https://tailwindcss.com) (via Vite)
*   **Interactivity (Animations)**: Vanilla JavaScript (Intersection Observer API)
*   **Fonts**: Google Fonts (Playfair Display, Inter)

## Installation & Setup

This project uses Laravel with Vite and Tailwind CSS. Ensure you have PHP, Composer, and Node.js installed on your machine.

1.  **Clone the Repository**
    *(If applicable, clone your repository here)*

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Set Up Environment**
    Copy the example `.env` file and generate an application key:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Install Node Dependencies**
    Install the frontend dependencies required by Vite and Tailwind CSS:
    ```bash
    npm install
    ```

5.  **Run Development Servers**
    To view the site locally, you need to run both the Laravel backend server and the Vite frontend build tool simultaneously in two separate terminal windows:

    *   **Terminal 1 (Laravel Server):**
        ```bash
        php artisan serve
        ```
        This typically starts the server at `http://localhost:8000` or `http://127.0.0.1:8000`.

    *   **Terminal 2 (Vite Server):**
        ```bash
        npm run dev
        ```
        This compiles the Tailwind CSS and enables hot module replacement (HMR) for incredibly fast development.

6.  **View the Application**
    Open your browser and navigate to the address provided by `php artisan serve` (e.g., `http://127.0.0.1:8000`). You should see the new Caféra landing page with smooth scroll animations.

## Project Structure (Key Files)

*   `resources/views/welcome.blade.php`: **This is the core of the project.** It contains the entire HTML structure, Tailwind utility classes for styling, embedded Google Fonts, and the inline JavaScript for the Intersection Observer animations.
*   `LIVEWIRE_INTEGRATION.md`: **Technical reference** for how Livewire was integrated into the dashboard views and components.
*   `package.json` & `vite.config.js`: Configuration for managing frontend assets (Tailwind CSS) via Vite.

## Customizing Animations

The scroll animations are controlled entirely within `welcome.blade.php`.
1.  **CSS Classes**: Look for the `<style>` block in the `<head>`. The `.reveal` class sets the initial state (invisible, shifted down), and `.reveal.active` sets the final state (visible, original position). The `.delay-*` classes control staggered timing.
2.  **JavaScript**: At the bottom of the file, the `<script>` tag contains the `IntersectionObserver` logic. You can modify the `threshold` (currently `0.15`) in the `options` object to change how early or late the elements start animating as they enter the screen.

## License
This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
