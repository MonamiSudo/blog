<?php
/*
This function based on Really Simple CAPTCHA 1.8.
modify matters
* add Hiragana ( Japanese ) CAPTCHA
* add randam line

Base-Plugin Name: Really Simple CAPTCHA
Base-Plugin URI: http://contactform7.com/captcha/
Base-Description: Really Simple CAPTCHA is a CAPTCHA module intended to be called from other plugins. It is originally created for my Contact Form 7 plugin.
Base-Author: Takayuki Miyoshi
Base-Version: 1.8
Base-Author URI: http://ideasilo.wordpress.com/
*/

/*  Copyright 2007-2014 Takayuki Miyoshi (email: takayukister at gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

class SiteGuardReallySimpleCaptcha extends SiteGuard_Base {
	/* Mode of character set alphabet(en) or hiragana(jp) */
	protected $lang_mode;

	/* Length of a word in an image */
	protected $char_length;

	/* Directory temporary keeping CAPTCHA images and corresponding text files */
	protected $tmp_dir;

	/* Array of CAPTCHA image size. Width and height */
	protected $img_size;

	/* Coordinates for a text in an image. I don't know the meaning. Just adjust. */
	protected $base;

	/* Font size */
	protected $font_size;

	/* Width of a character */
	protected $font_char_width;

	/* Image type. 'png', 'gif' or 'jpeg' */
	protected $img_type;

	/* Mode of temporary image files */
	protected $file_mode;

	/* Mode of temporary answer text files */
	protected $answer_file_mode;

	public function __construct() {
		$this->lang_mode = 'jp';
		$this->char_length = 4;
		$this->tmp_dir = path_join( dirname( __FILE__ ), 'tmp' );
		$this->img_size = array( 72, 24 );
		$this->base = array( 6, 18 );
		$this->font_size = 14;
		$this->font_char_width = 15;
		$this->img_type = 'png';
		$this->file_mode = 0444;
		$this->answer_file_mode = 0440;
	}

	/**
	 * Generate and return a random word.
	 *
	 * @return string Random word with $chars characters x $char_length length
	 */
	public function generate_random_word() {

		/* Characters available in images */
		$chars_en = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
		$chars_jp = 'あいうえおかきくけこさしすせそたちつてとなにのひふへまみむもやゆよらりん';

		$word = '';

		if ( 'jp' == $this->lang_mode ) {
			$this->chars = $chars_jp;
		} else {
			$this->chars = $chars_en;
		}

		$chars_size = mb_strlen( $this->chars );
		for ( $i = 0; $i < $this->char_length; $i++ ) {
			$pos = mt_rand( 0, $chars_size - 1 );
			$char = mb_substr( $this->chars, $pos, 1 );
			$word .= $char;
		}

		return $word;
	}

	/**
	 * Generate CAPTCHA image and corresponding answer file.
	 *
	 * @param string $prefix File prefix used for both files
	 * @param string $word Random word generated by generate_random_word()
	 * @return string|bool The file name of the CAPTCHA image. Return false if temp directory is not available.
	 */
	public function generate_image( $prefix, $word ) {
		if ( ! $this->make_tmp_dir() )
			return false;

		$this->cleanup();

		/* Array of fonts. Randomly picked up per character */
		if ( 'jp' == $this->lang_mode ) {
			$this->fonts = array(
				dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1c-hiragana-black.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1c-hiragana-bold.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1c-hiragana-heavy.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1c-hiragana-light.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1c-hiragana-medium.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1c-hiragana-regular.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1c-hiragana-thin.ttf',
				dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1m-hiragana-bold.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1m-hiragana-light.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1m-hiragana-medium.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1m-hiragana-regular.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1m-hiragana-thin.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1mn-hiragana-bold.ttf',
				dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1mn-hiragana-light.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1mn-hiragana-medium.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1mn-hiragana-regular.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1mn-hiragana-thin.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1p-hiragana-black.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1p-hiragana-bold.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1p-hiragana-heavy.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1p-hiragana-light.ttf',
				dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1p-hiragana-medium.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1p-hiragana-regular.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-1p-hiragana-thin.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2c-hiragana-black.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2c-hiragana-bold.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2c-hiragana-heavy.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2c-hiragana-light.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2c-hiragana-medium.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2c-hiragana-regular.ttf',
				dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2c-hiragana-thin.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2m-hiragana-bold.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2m-hiragana-light.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2m-hiragana-medium.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2m-hiragana-regular.ttf',
				dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2m-hiragana-thin.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2p-hiragana-black.ttf',
				dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2p-hiragana-bold.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2p-hiragana-heavy.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2p-hiragana-light.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2p-hiragana-medium.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2p-hiragana-regular.ttf',
				//dirname( __FILE__ ) . '/mplus-TESTFLIGHT-058/mplus-2p-hiragana-thin.ttf',
			);
		} else {
			$this->fonts = array(
				dirname( __FILE__ ) . '/gentium/GenBkBasR.ttf',
				dirname( __FILE__ ) . '/gentium/GenBkBasI.ttf',
				dirname( __FILE__ ) . '/gentium/GenBkBasBI.ttf',
				dirname( __FILE__ ) . '/gentium/GenBkBasB.ttf',
			 );
		}

		$dir = trailingslashit( $this->tmp_dir );
		$filename = null;

		if ( $im = imagecreatetruecolor( $this->img_size[0], $this->img_size[1] ) ) {
			$bg = imagecolorallocate( $im, 255, 255, 255 );
			$fg = imagecolorallocate( $im, 0, 0, 0 );

			imagefill( $im, 0, 0, $bg );

			// randam lines
			for ( $i = 0; $i < 5; $i++ ) {
				$color  = imagecolorallocate( $im, 196, 196, 196 );
				imageline( $im, mt_rand( 0, $this->img_size[0] - 1 ), mt_rand( 0, $this->img_size[1] - 1 ), mt_rand( 0, $this->img_size[0] - 1 ), mt_rand( 0, $this->img_size[1] - 1 ), $color );
			}

			$x = $this->base[0] + mt_rand( -2, 2 );

			$gd_info = gd_info( );
			$word_size = mb_strlen( $word );
			for ( $i = 0; $i < $word_size; $i++ ) {
				$font = $this->fonts[ array_rand( $this->fonts ) ];
				$font = $this->normalize_path( $font );
				if ( $gd_info['JIS-mapped Japanese Font Support'] ) {
					$char = mb_convert_encoding( mb_substr( $word, $i, 1 ), 'SJIS', 'UTF-8' );
				} else {
					$char = mb_substr( $word, $i, 1 );
				}
				imagettftext( $im, $this->font_size, mt_rand( -12, 12 ), $x, $this->base[1] + mt_rand( -2, 2 ), $fg, $font, $char );
				$x += $this->font_char_width;
			}

			switch ( $this->img_type ) {
				case 'jpeg':
					$filename = sanitize_file_name( $prefix . '.jpeg' );
					$file = $this->normalize_path( $dir . $filename );
					imagejpeg( $im, $file );
					break;
				case 'gif':
					$filename = sanitize_file_name( $prefix . '.gif' );
					$file = $this->normalize_path( $dir . $filename );
					imagegif( $im, $file );
					break;
				case 'png':
				default:
					$filename = sanitize_file_name( $prefix . '.png' );
					$file = $this->normalize_path( $dir . $filename );
					imagepng( $im, $file );
			}

			imagedestroy( $im );
			@chmod( $file, $this->file_mode );
		}

		$this->generate_answer_file( $prefix, $word );

		return $filename;
	}

	/**
	 * Generate answer file corresponding to CAPTCHA image.
	 *
	 * @param string $prefix File prefix used for answer file
	 * @param string $word Random word generated by generate_random_word()
	 */
	public function generate_answer_file( $prefix, $word ) {
		$dir = trailingslashit( $this->tmp_dir );
		$answer_file = $dir . sanitize_file_name( $prefix . '.txt' );
		$answer_file = $this->normalize_path( $answer_file );

		if ( $fh = @fopen( $answer_file, 'w' ) ) {
			$word = strtoupper( $word );
			$salt = wp_generate_password( 64 );
			$hash = hash_hmac( 'md5', $word, $salt );

			$code = $salt . '|' . $hash;

			fwrite( $fh, $code );
			fclose( $fh );
		} else {
			siteguard_error_log( 'failed to open file (' . $answer_file . '). : ' . __FILENAME__ );
		}

		@chmod( $answer_file, $this->answer_file_mode );
	}

	/**
	 * Check a response against the code kept in the temporary file.
	 *
	 * @param string $prefix File prefix used for both files
	 * @param string $response CAPTCHA response
	 * @return bool Return true if the two match, otherwise return false.
	 */
	public function check( $prefix, $response, $remove = false ) {
		if ( 0 == strlen( $prefix ) ) {
			return false;
		}

		$response = str_replace( array( ' ', "\t" ), '', $response );
		$response = strtoupper( $response );

		$dir = trailingslashit( $this->tmp_dir );
		$filename = sanitize_file_name( $prefix . '.txt' );
		$file = $this->normalize_path( $dir . $filename );

		if ( @is_readable( $file ) && ( $code = file_get_contents( $file ) ) ) {
			$code = explode( '|', $code, 2 );

			$salt = $code[0];
			$hash = $code[1];
			if ( hash_hmac( 'md5', $response, $salt ) == $hash ) {
				if ( $remove ) {
					$this->remove( $prefix );
				}
				return true;
			}
		}

		if ( $remove ) {
			$this->remove( $prefix );
		}
		return false;
	}

	/**
	 * Remove temporary files with given prefix.
	 *
	 * @param string $prefix File prefix
	 */
	public function remove( $prefix ) {
		$suffixes = array( '.jpeg', '.gif', '.png', '.php', '.txt' );

		foreach ( $suffixes as $suffix ) {
			$dir = trailingslashit( $this->tmp_dir );
			$filename = sanitize_file_name( $prefix . $suffix );
			$file = $this->normalize_path( $dir . $filename );

			if ( @is_file( $file ) ) {
				unlink( $file );
			}
		}
	}

	/**
	 * Clean up dead files older than given length of time.
	 *
	 * @param int $minutes Consider older files than this time as dead files
	 * @return int|bool The number of removed files. Return false if error occurred.
	 */
	public function cleanup( $minutes = 60 ) {
		$dir = trailingslashit( $this->tmp_dir );
		$dir = $this->normalize_path( $dir );

		if ( ! @is_dir( $dir ) || ! @is_readable( $dir ) ) {
			siteguard_error_log( $dir . ' is not directory or readable. :' . __FILENAME__ );
			return false;
		}

		$is_win = ( 'WIN' === strtoupper( substr( PHP_OS, 0, 3 ) ) );

		if ( ! ( $is_win ? win_is_writable( $dir ) : @is_writable( $dir ) ) ) {
			siteguard_error_log( $dir . ' is not writable. :' . __FILENAME__ );
			return false;
		}

		$count = 0;

		if ( $handle = @opendir( $dir ) ) {
			while ( false !== ( $filename = readdir( $handle ) ) ) {
				if ( ! preg_match( '/^[0-9]+\.(php|txt|png|gif|jpeg)$/', $filename ) )
					continue;

				$file = $this->normalize_path( $dir . $filename );

				$stat = @stat( $file );
				if ( ( $stat['mtime'] + $minutes * 60 ) < time() ) {
					if ( ! @unlink( $file ) ) {
						@chmod( $file, 0644 );
						@unlink( $file );
					}
					$count += 1;
				}
			}

			closedir( $handle );
		}

		return $count;
	}

	/**
	 * Make a temporary directory and generate .htaccess file in it.
	 *
	 * @return bool True on successful create, false on failure.
	 */
	public function make_tmp_dir() {
		global $siteguard_config;

		$dir = trailingslashit( $this->tmp_dir );
		$dir = $this->normalize_path( $dir );

		if ( ! wp_mkdir_p( $dir ) ) {
			siteguard_error_log( 'failed to make directory (' . $dir . '). :' . __FILENAME__ );
			return false;
		}

		$htaccess_file = $this->normalize_path( $dir . '.htaccess' );

		// add 'Satisfy Any' in .htaccess from version 1.2.0
		if ( version_compare( $siteguard_config->get( 'version' ), '1.2.0' ) < 0 ) {
			@unlink( $htaccess_file );
		}

		if ( ! file_exists( $htaccess_file ) ) {
			if ( $handle = @fopen( $htaccess_file, 'w' ) ) {
				fwrite( $handle, 'RewriteEngine On' . "\n" );
				fwrite( $handle, 'RewriteRule \.txt - [F]' . "\n" );
				fclose( $handle );
			} else {
				siteguard_error_log( 'failed to open file (' . $htaccess_file . '). :' . __FILENAME__ );
			}
		}

		$dmy_src_file = SITEGUARD_PATH . 'images/dummy.png';
		$dmy_dst_file = $dir . 'dummy.png';

		if ( ! file_exists( $dmy_dst_file ) ) {
			return @copy( $dmy_src_file, $dmy_dst_file );
		}

		return true;
	}

	/**
	 * Normalize a filesystem path.
	 *
	 * This should be replaced by wp_normalize_path when the plugin's
	 * minimum requirement becomes WordPress 3.9 or higher.
	 *
	 * @param string $path Path to normalize.
	 * @return string Normalized path.
	 */
	private function normalize_path( $path ) {
		$path = str_replace( '\\', '/', $path );
		$path = preg_replace( '|/+|', '/', $path );
		return $path;
	}

	/**
 	 * set $this->lang_mode
	 */
	public function set_lang_mode( $mode ) {
		if ( 'jp' === $mode || 'en' === $mode ) {
			$this->lang_mode = $mode;
		}
	}
}
