document.addEventListener('DOMContentLoaded', () => {
    // تحسين التأثيرات عند التركيز على الحقول
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');

    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.borderColor = '#4f46e5';
            input.style.boxShadow = '0 0 0 1px #4f46e5';
        });

        input.addEventListener('blur', () => {
            input.style.borderColor = '#d1d5db';
            input.style.boxShadow = 'none';
        });
    });

    // إضافة التأثيرات على الأزرار
    const buttons = document.querySelectorAll('button');

    buttons.forEach(button => {
        button.addEventListener('mouseover', () => {
            button.style.backgroundColor = '#4338ca';
            button.style.transform = 'scale(1.02)';
        });

        button.addEventListener('mouseout', () => {
            button.style.backgroundColor = '#4f46e5';
            button.style.transform = 'scale(1)';
        });

        button.addEventListener('mousedown', () => {
            button.style.backgroundColor = '#3730a3';
        });

        button.addEventListener('mouseup', () => {
            button.style.backgroundColor = '#4f46e5';
        });
    });

    // تحسين رسالة الخطأ
    const errorMessages = document.querySelectorAll('.input-error');

    errorMessages.forEach(error => {
        error.style.opacity = 0;
        setTimeout(() => {
            error.style.transition = 'opacity 0.3s ease';
            error.style.opacity = 1;
        }, 100);
    });
});
