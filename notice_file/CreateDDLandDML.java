package technic;

import java.lang.annotation.ElementType;
import java.lang.annotation.Retention;
import java.lang.annotation.RetentionPolicy;
import java.lang.annotation.Target;
import java.lang.reflect.Constructor;
import java.lang.reflect.Field;
import java.lang.reflect.InvocationTargetException;
import java.lang.reflect.Method;
import java.lang.reflect.Parameter;
import java.text.SimpleDateFormat;
import java.util.Date;

class Util {
	public static String toSnakeCase(String camelCase) {
		String converted = "";
		
		for (int i = 0; i < camelCase.length(); i++) {
			char c = camelCase.charAt(i);
			if(i == 0) {
				if(c >= 65 && c <= 90) {
					converted += (char) (c + 32);
				} else {
					converted += c;
				}
			} else {
				if(c >= 65 && c <= 90) {
					converted += "_";
					converted += (char) (c + 32);
				} else {
					converted += c;	
				}
			}
		}
		
//		final int len = chars.length;
//	       for (int i = 0; i < len; i++) {
//	           if (chars[i] <= ' ') {
//	               doThrow();
//	           }
//	     }
		
		return converted;
	}
}

@Retention(RetentionPolicy.RUNTIME)
@Target(ElementType.FIELD)
@interface MyId {}

@Retention(RetentionPolicy.RUNTIME)
@Target(ElementType.FIELD)
@interface MyColumn {
    public String name() default "";
    public boolean unique() default false;
    public boolean nullable() default true;
}

class Person {
	private String name;
	private Integer age;
	private String gender;

	public Person() {
		super();
	}
	public Person(String name, int age, String gender) {
		super();
		this.name = name;
		this.age = age;
		this.gender = gender;
	}
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public Integer getAge() {
		return age;
	}
	public void setAge(int age) {
		this.age = age;
	}
	public String getGender() {
		return gender;
	}
	public void setGender(String gender) {
		this.gender = gender;
	}
	@Override
	public String toString() {
		return "Person [name=" + name + ", age=" + age + ", gender=" + gender + "]";
	}
}

class MyEntity {
	@MyId
	private Integer value1;
	@MyColumn(name="my_value_2", unique=true, nullable=false)
	private String value2;
	private Long value3;
	@MyColumn(name="my_value_4")
	private Float value4;
	@MyColumn(nullable=false)
	private Double value5;
	private Date value6;
	private String helloWorld;
	
	public MyEntity() {
		super();
	}
	public MyEntity(Integer value1, String value2, Long value3, Float value4, Double value5, Date value6,
			String helloWorld) {
		super();
		this.value1 = value1;
		this.value2 = value2;
		this.value3 = value3;
		this.value4 = value4;
		this.value5 = value5;
		this.value6 = value6;
		this.helloWorld = helloWorld;
	}
	public Integer getValue1() {
		return value1;
	}
	public void setValue1(Integer value1) {
		this.value1 = value1;
	}
	public String getValue2() {
		return value2;
	}
	public void setValue2(String value2) {
		this.value2 = value2;
	}
	public Long getValue3() {
		return value3;
	}
	public void setValue3(Long value3) {
		this.value3 = value3;
	}
	public Float getValue4() {
		return value4;
	}
	public void setValue4(Float value4) {
		this.value4 = value4;
	}
	public Double getValue5() {
		return value5;
	}
	public void setValue5(Double value5) {
		this.value5 = value5;
	}
	public Date getValue6() {
		return value6;
	}
	public void setValue6(Date value6) {
		this.value6 = value6;
	}
	public String getHelloWorld() {
		return helloWorld;
	}
	public void setHelloWorld(String helloWorld) {
		this.helloWorld = helloWorld;
	}
}

class MyController {
	public void needPerson(Person p) {
		System.out.println(p);
	}
}

public class CreateDDLandDML {

	public static <T> Object queryStringToObject(Class<T> c, String queryString) throws Exception {
		// 생성자 객체 반환 (여러개의 생성자가 있을 수 있음, 따라서 배열을 반환, 여기서는 기본 생성자)
		Constructor constructor = c.getConstructors()[0];
		// 생성자 호출 및 캐스팅
		Object o = c.cast(constructor.newInstance());
		
		for(String pair : queryString.split("&")) {
			String name = pair.split("=")[0];
			String value = pair.split("=")[1];
			
			// 모든 public 메소드 순회 
			for(Method m : c.getMethods()) {
				// 세터 이름 설정
				String setterName = "set" + name.substring(0, 1).toUpperCase() + name.substring(1);
				// 세터 존재 여부 확인
				if(m.getName().equals(setterName)) {
					// 세터의 첫 번째 파라미터 클래스 타입 확인 (세터는 파라미터가 하나이므로 0번째 위치 파라미터의 타입만 확인)
					Class paramClass = m.getParameterTypes()[0];
					String paramClassTypeName = paramClass.getSimpleName();
					// 클래스 타입에 따라 적절히 변환 작업 진행한 후 세터 호출 (지금은 정수 타입만 처리할 수 있도록 구현함)
					if(paramClassTypeName.equals("Integer") || paramClassTypeName.equals("int")) {
						m.invoke(o, Integer.parseInt(value));
					} else {
						m.invoke(o, value);	
					}
				}
			}
		}
		
		return o;
	}
	
	public static <T> String createDDL(Class<T> c) {
		String DDL = "CREATE TABLE "  + Util.toSnakeCase(c.getSimpleName()) + " (";
		DDL += "\n";
		
		// 클래스의 필드 정보 얻어오기 (getDeclaredFields 메소드 호출했으므로 private 필드도 모두 순회 가능)
		Field[] fields = c.getDeclaredFields();
		int idx = 0;
		for(Field f : fields) {
			// 칼럼 관련 어노테이션 붙어있는지 여부 확인
			boolean columnAnnotationPresent = f.isAnnotationPresent(MyColumn.class);
			if(columnAnnotationPresent) {
				// 칼럼 정보 있으면 칼럼 정보를 포함한 객체 얻어오기
				MyColumn columnInfo = f.getAnnotation(MyColumn.class);
				// 이름을 설정했는지 확인
				if(columnInfo.name().trim().length() == 0) {
					DDL += "\t" + Util.toSnakeCase(f.getName()) + " ";
				} else {
					DDL += "\t" + columnInfo.name() + " ";
				}
			} else {
				DDL += "\t" + Util.toSnakeCase(f.getName()) + " ";
			}
			// 필드 타입 얻어오기
			Class type = f.getType();
			String typeName = type.getSimpleName();
			
			// 필드 타입에 따라 적절한 데이터베이스 타입으로 변경하여 DDL 구문 추가
			if(typeName.equals("String")) DDL += "varchar(255)";
			if(typeName.equals("Integer") || typeName.equals("int")) DDL += "int";
			if(typeName.equals("Long") || typeName.equals("long")) DDL += "bigint";
			if(typeName.equals("Float") || typeName.equals("float")) DDL += "float";
			if(typeName.equals("Double") || typeName.equals("double")) DDL += "double";
			if(typeName.equals("Date")) DDL += "datetime";
			
			if(columnAnnotationPresent) {
				// 칼럼 존재 여부 및 unique, nullable 설정 여부 확인
				MyColumn columnInfo = f.getAnnotation(MyColumn.class);
				if(columnInfo.unique()) DDL += " unique";
				if(!columnInfo.nullable()) DDL += " not null";
			}
			// Id 어노테이션 여부 확인 (해당 어노테이션은 존재하는지 여부만 확인하면 되므로 따로 값을 조회하는 로직은 없음)
			if(f.isAnnotationPresent(MyId.class)) {
				DDL += " primary key";
			}
			
			if(fields.length -1 != idx) {
				DDL += ",";
			}
			DDL += "\n";
			idx++;
		}
		
		DDL += ")";
		return DDL;
	}
	
	public static String createInsertDML(Object o) throws Exception {
		// 객체에 타입 확인 후 적절한 insert DML 구문 생성
		// ex: insert into person(name, age, gender) values("김철수", 20, "남자");
		String DML = "INSERT INTO ";
		
		// 객체의 클래스 타입 확인
		Class c = o.getClass();
		DML += Util.toSnakeCase(c.getSimpleName()) + "(";
		
		int idx = 0;
		// (name, age, gender) <= 이 부분 생성
		for(Field f : c.getDeclaredFields()) {
			// 칼럼에서 이름(name)을 직접 바꾸었을 수도 있으므로 확인
			if(f.isAnnotationPresent(MyColumn.class)) {
				if(f.getAnnotation(MyColumn.class).name().trim().length() > 0) {
					DML += f.getAnnotation(MyColumn.class).name().trim();
				} else {
					DML += Util.toSnakeCase(f.getName());	
				}
			} else {
				DML += Util.toSnakeCase(f.getName());
			}
			if(idx != c.getDeclaredFields().length - 1) DML += ",";
			idx++;
		}
		
		DML += ")";
		
		DML += " values(";
		
		idx = 0;
		for(Field f : c.getDeclaredFields()) {
			// 게터 메소드 얻어오기
			Method m = c.getMethod("get" + ((char) (f.getName().charAt(0) - 32)) + (f.getName().substring(1, f.getName().length())));
			// 게터 호출하여 values 괄호 안에 추가
			Object obj = m.invoke(o);
			if(obj == null) {
				DML += "null";
			} else {
				if(obj instanceof String) {
					DML += "\"" + obj.toString() + "\"";
				} else if(obj instanceof Date) {
					// Date 타입의 경우 MySQL에 적절한 데이터 정의 형식으로 출력할 수 있도록 작업
					String pattern = "yyyy-MM-dd hh:mm:ss";
					SimpleDateFormat simpleDateFormat = new SimpleDateFormat(pattern);
					DML += "\"" + simpleDateFormat.format(obj) + "\"";
				} else {
					DML += obj.toString();
				}
			}
			
			if(idx != c.getDeclaredFields().length - 1) DML += ",";
			idx++;
		}
		
		DML += ")";
		
		return DML;
	}
	
	public static void main(String[] args) throws Exception {
		// 커맨트 객체 생성 따라해보기
		String queryString = "name=John&age=29&gender=male";
		queryString = "name=Anna&age=32&gender=female";
		queryString = "name=Anna&age=32";
		
		MyController controller = new MyController();
		for(Method m : controller.getClass().getMethods()) {
			String methodName = m.getName();
			if(methodName.startsWith("need")) {
				Class c = m.getParameters()[0].getType();
				Object o = c.cast(queryStringToObject(c, queryString));
				m.invoke(controller, o);
			}
		}
		
		String DDL = createDDL(Person.class);
		System.out.println(DDL);
		
		System.out.println(createDDL(MyEntity.class));
		
		Person p1 = new Person("김철수", 20, "남자");
		Person p2 = new Person("이영희", 30, "여자");
		Person p3 = new Person();
		p3.setName("이미림");
		
		System.out.println(createInsertDML(p1));
		System.out.println(createInsertDML(p2));
		System.out.println(createInsertDML(p3));
		
		MyEntity e1 = new MyEntity(1, "Hello", 100L, 3.0F, 1.234, new Date(), "World");
		MyEntity e2 = new MyEntity(2, "Hello2", 100L, 3.0F, 1.234, new Date(), "World2");
		System.out.println(createInsertDML(e1));
		System.out.println(createInsertDML(e2));
	}

}