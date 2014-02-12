package dssd.invoker.test;

import junit.framework.TestCase;
import dssd.invoker.Constants;

public class TestConstants extends TestCase {

	public TestConstants(String name) {
		super(name);
	}

	protected void setUp() throws Exception {
		super.setUp();
	}
	
	public void testIsPresent(){
		assertTrue(Constants.isClassPresent());
	}

	protected void tearDown() throws Exception {
		super.tearDown();
	}

}
