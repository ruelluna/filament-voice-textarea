<?php

namespace Ruelluna\FilamentVoiceTextarea\Examples;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Ruelluna\FilamentVoiceTextarea\Forms\Components\VoiceTextarea;

class VoiceTextareaExample
{
    /**
     * Basic usage example
     */
    public static function basicExample(): array
    {
        return [
            VoiceTextarea::make('description')
                ->label('Description')
                ->enableVoice()
                ->helperText('Click the microphone icon to start voice recognition')
                ->required(),
        ];
    }

    /**
     * Advanced usage example with multiple options
     */
    public static function advancedExample(): array
    {
        return [
            TextInput::make('title')
                ->label('Title')
                ->required(),

            VoiceTextarea::make('content')
                ->label('Article Content')
                ->enableVoice()
                ->rows(10)
                ->placeholder('Start typing or click the microphone to dictate...')
                ->helperText('Use voice recognition for faster content creation')
                ->required()
                ->columnSpanFull(),

            Select::make('category')
                ->label('Category')
                ->options([
                    'technology' => 'Technology',
                    'business' => 'Business',
                    'lifestyle' => 'Lifestyle',
                ])
                ->required(),

            Toggle::make('published')
                ->label('Published')
                ->default(false),
        ];
    }

    /**
     * Form with multiple voice textareas
     */
    public static function multipleVoiceTextareasExample(): array
    {
        return [
            VoiceTextarea::make('summary')
                ->label('Summary')
                ->enableVoice()
                ->rows(3)
                ->helperText('Brief summary of the content')
                ->required(),

            VoiceTextarea::make('main_content')
                ->label('Main Content')
                ->enableVoice()
                ->rows(15)
                ->helperText('Main content of the article')
                ->required()
                ->columnSpanFull(),

            VoiceTextarea::make('conclusion')
                ->label('Conclusion')
                ->enableVoice()
                ->rows(4)
                ->helperText('Concluding thoughts')
                ->required(),
        ];
    }

    /**
     * Complete form example for a blog post
     */
    public static function blogPostForm(): array
    {
        return [
            TextInput::make('title')
                ->label('Post Title')
                ->required()
                ->maxLength(255),

            VoiceTextarea::make('excerpt')
                ->label('Excerpt')
                ->enableVoice()
                ->rows(3)
                ->helperText('Brief description of the post')
                ->maxLength(500),

            VoiceTextarea::make('content')
                ->label('Post Content')
                ->enableVoice()
                ->rows(20)
                ->placeholder('Write your post content here or use voice recognition...')
                ->helperText('Main content of your blog post. Use the microphone for voice input.')
                ->required()
                ->columnSpanFull(),

            Select::make('status')
                ->label('Status')
                ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                    'archived' => 'Archived',
                ])
                ->default('draft')
                ->required(),

            Toggle::make('featured')
                ->label('Featured Post')
                ->default(false),
        ];
    }
}
