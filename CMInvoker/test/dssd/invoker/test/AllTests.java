package dssd.invoker.test;

import dssd.invoker.CMProperties;
import junit.framework.Test;
import junit.framework.TestSuite;

public class AllTests {

	public static Test suite() {
		CMProperties.loadProperties();
		
		TestSuite suite = new TestSuite("Test for dssd.invoker.test");
		//$JUnit-BEGIN$
		suite.addTestSuite(TestInvokeService.class);
		suite.addTestSuite(TestDatabase.class);
		suite.addTestSuite(TestMyExternalThread.class);
		suite.addTestSuite(TestInvokeParameter.class);
		suite.addTestSuite(TestCMProperties.class);
		suite.addTestSuite(TestHelper.class);
		suite.addTestSuite(TestConstants.class);
                suite.addTestSuite(TestLoadFromTextFile.class);
		//$JUnit-END$
		return suite;
	}

}
