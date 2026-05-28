<script>
    window.initHomeCallbackTrigger = function initHomeCallbackTrigger() {
        const storageKey = 'cb_trigger_shown_v1';

        if (sessionStorage.getItem(storageKey)) {
            return;
        }

        let isTriggered = false;

        const fire = (source) => {
            if (isTriggered || sessionStorage.getItem(storageKey)) {
                return;
            }

            isTriggered = true;
            sessionStorage.setItem(storageKey, '1');
            window.dispatchEvent(new CustomEvent('open-callback', { detail: { source } }));
        };

        if (window.matchMedia('(pointer: coarse)').matches) {
            let hasInteracted = false;

            const markInteract = () => {
                if (hasInteracted) {
                    return;
                }

                hasInteracted = true;
                window.setTimeout(() => fire('time_delay'), 45000);
            };

            window.addEventListener('scroll', markInteract, { once: true, passive: true });
            window.addEventListener('touchstart', markInteract, { once: true, passive: true });

            return;
        }

        document.addEventListener('mouseleave', (event) => {
            if (event.clientY <= 0) {
                fire('exit_intent');
            }
        });
    };
</script>
