// Textarea autosize functionality
window.textareaAutosize = function() {
    return {
        autosize() {
            const textarea = this.$el;
            const resize = () => {
                textarea.style.height = 'auto';
                textarea.style.height = textarea.scrollHeight + 'px';
            };

            textarea.addEventListener('input', resize);
            resize();
        }
    };
};

window.voiceTextarea = function() {
    return {
        isListening: false,
        recognition: null,
        textarea: null,

        init() {
            // Find the textarea - it could be this.$el (if x-data is on textarea) or a child
            this.textarea = this.$el.tagName === 'TEXTAREA' ? this.$el : this.$el.querySelector('textarea');
            this.initSpeechRecognition();
        },

        initSpeechRecognition() {
            // Check if speech recognition is supported
            if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
                console.warn('Speech recognition is not supported in this browser');
                return;
            }

            // Initialize speech recognition
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            this.recognition = new SpeechRecognition();

            // Get configuration from data attributes
            const textarea = this.$el.querySelector('textarea');
            const language = textarea?.getAttribute('data-voice-language') || 'en-US';
            const continuous = textarea?.getAttribute('data-voice-continuous') !== 'false';
            const interim = textarea?.getAttribute('data-voice-interim') !== 'false';

            // Configure recognition settings
            this.recognition.continuous = continuous;
            this.recognition.interimResults = interim;
            this.recognition.lang = language;

            // Event handlers
            this.recognition.onstart = () => {
                this.isListening = true;
                console.log('Voice recognition started');
            };

            this.recognition.onresult = (event) => {
                let interimTranscript = '';
                let finalTranscript = '';

                for (let i = event.resultIndex; i < event.results.length; i++) {
                    const transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) {
                        finalTranscript += transcript;
                    } else {
                        interimTranscript += transcript;
                    }
                }

                // Update textarea with recognized text
                if (finalTranscript) {
                    const currentValue = this.textarea.value;
                    const newValue = currentValue + (currentValue ? ' ' : '') + finalTranscript;
                    this.textarea.value = newValue;

                    // Trigger input event for Filament/Livewire
                    this.textarea.dispatchEvent(new Event('input', { bubbles: true }));
                    this.textarea.dispatchEvent(new Event('change', { bubbles: true }));
                }
            };

            this.recognition.onerror = (event) => {
                console.error('Speech recognition error:', event.error);
                this.isListening = false;

                // Show user-friendly error message
                if (event.error === 'not-allowed') {
                    alert('Please allow microphone access to use voice recognition.');
                } else if (event.error === 'no-speech') {
                    alert('No speech detected. Please try again.');
                } else {
                    alert('Voice recognition error: ' + event.error);
                }
            };

            this.recognition.onend = () => {
                this.isListening = false;
                console.log('Voice recognition ended');
            };
        },

        toggleVoiceRecognition() {
            if (!this.recognition) {
                alert('Speech recognition is not supported in this browser. Please use Chrome, Edge, or Safari.');
                return;
            }

            if (this.isListening) {
                this.stopVoiceRecognition();
            } else {
                this.startVoiceRecognition();
            }
        },

        startVoiceRecognition() {
            try {
                this.recognition.start();
            } catch (error) {
                console.error('Error starting voice recognition:', error);
                alert('Error starting voice recognition. Please try again.');
            }
        },

        stopVoiceRecognition() {
            try {
                this.recognition.stop();
            } catch (error) {
                console.error('Error stopping voice recognition:', error);
            }
        }
    };
};
