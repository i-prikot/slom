import './bootstrap';
import '../../vendor/masmerise/livewire-toaster/resources/js';

const messengerTexts = {
    default: 'Здравствуйте! Подскажите по алмазной резке/бурению — нужен расчёт.',
    hero: 'Здравствуйте! Хочу заказать алмазную резку. Подскажите цену и сроки выезда.',
    pricing: 'Здравствуйте! Уточните, пожалуйста, точную стоимость по моему объекту.',
    calculator: 'Здравствуйте! Рассчитал ориентировочную стоимость на сайте — хочу уточнить детали и сроки выезда.',
    emergency: 'Здравствуйте! Срочная ситуация — нужен выезд бригады как можно быстрее.',
    services: 'Здравствуйте! Интересует услуга — нужна консультация и расчёт.',
    footer: 'Здравствуйте! Оставляю заявку на консультацию по алмазной резке.',
};

window.slomReachGoal = function slomReachGoal(goal) {
    if (typeof window.ym !== 'function' || !window.slomYandexMetrikaId) {
        return;
    }

    window.ym(window.slomYandexMetrikaId, 'reachGoal', goal);
};

window.slomTrackCTA = function slomTrackCTA(type, source) {
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        event: 'cta_click',
        cta_type: type,
        cta_source: source,
        ts: Date.now(),
    });

    if (typeof window.ym === 'function') {
        window.ym('reachGoal', `cta_${type}_${source}`);
    }
};

window.slomMessengerUrl = function slomMessengerUrl(base, source = 'default') {
    const text = messengerTexts[source] ?? messengerTexts.default;

    return `${base}?text=${encodeURIComponent(text)}`;
};

window.slomMessengerUrlWithCalc = function slomMessengerUrlWithCalc(base, summary) {
    const text = `Здравствуйте! Рассчитал на сайте:\n${summary}\nПодскажите, когда сможете приехать?`;

    return `${base}?text=${encodeURIComponent(text)}`;
};
