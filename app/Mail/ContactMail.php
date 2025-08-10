<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
	use Queueable, SerializesModels;
	private $name;
	private $title;
	private $descsription;
	private $phone;
	/**
	 * Create a new message instance.
	 */
	public function __construct($data)
	{
		// gán dự liệu vào đây
		$this->name = request('name');
		$this->title = request('title');
		$this->descsription = request('descsription');
		$this->phone = request('phone');
	}

	/**
	 * Get the message envelope.
	 */
	public function envelope(): Envelope
	{
		return new Envelope(
			from: new Address('phamhoangnhan09z12@gmail.com', 'Hoang Nhan'),
			subject: 'Contact Mail',
		);
	}

	/**
	 * Get the message content definition.
	 */
	public function content(): Content
	{
		return new Content(
			view: 'email.contact',
			with: [
				'orderName' => $this->name,
				'orderPrice' => $this->title,
				'orderdescsription' => $this->descsription,
				'orderphone' => $this->phone,
			],
		);
	}

	/**
	 * Get the attachments for the message.
	 *
	 * @return array<int, \Illuminate\Mail\Mailables\Attachment>
	 */
	public function attachments(): array
	{
		return [];
	}
}
