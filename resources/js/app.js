import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Agregar un console.log para verificar que el archivo se cargó
console.log('JavaScript file loaded correctly');

// Si quieres hacer un log de algún dato específico, puedes hacer algo como:
const data = {
    message: 'Este es un mensaje de prueba para el dashboard',
    totalPacientes: 10, // Puedes cambiar esto por los datos reales
};

console.log('Dashboard Data:', data);
