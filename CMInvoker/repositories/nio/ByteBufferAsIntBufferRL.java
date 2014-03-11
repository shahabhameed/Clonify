/*
 * @(#)ByteBufferAs-X-Buffer.java	1.17 04/05/03
 *
 * Copyright 2004 Sun Microsystems, Inc. All rights reserved.
 * SUN PROPRIETARY/CONFIDENTIAL. Use is subject to license terms.
 */

// -- This file was mechanically generated: Do not edit! -- //

package java.nio;


class ByteBufferAsIntBufferRL			// package-private
    extends ByteBufferAsIntBufferL
{








    ByteBufferAsIntBufferRL(ByteBuffer bb) {	// package-private












	super(bb);

    }

    ByteBufferAsIntBufferRL(ByteBuffer bb,
				     int mark, int pos, int lim, int cap,
				     int off)
    {





	super(bb, mark, pos, lim, cap, off);

    }

    public IntBuffer slice() {
	int pos = this.position();
	int lim = this.limit();
	assert (pos <= lim);
	int rem = (pos <= lim ? lim - pos : 0);
	int off = (pos << 2) + offset;
        assert (off >= 0);
	return new ByteBufferAsIntBufferRL(bb, -1, 0, rem, rem, off);
    }

    public IntBuffer duplicate() {
	return new ByteBufferAsIntBufferRL(bb,
						    this.markValue(),
						    this.position(),
						    this.limit(),
						    this.capacity(),
						    offset);
    }

    public IntBuffer asReadOnlyBuffer() {








	return duplicate();

    }

















    public IntBuffer put(int x) {




	throw new ReadOnlyBufferException();

    }

    public IntBuffer put(int i, int x) {




	throw new ReadOnlyBufferException();

    }

    public IntBuffer compact() {
















	throw new ReadOnlyBufferException();

    }

    public boolean isDirect() {
	return bb.isDirect();
    }

    public boolean isReadOnly() {
	return true;
    }









































    public ByteOrder order() {




	return ByteOrder.LITTLE_ENDIAN;

    }

}
