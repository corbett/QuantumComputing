#!/usr/bin/env python
# Author: corbett@caltech.edu

import numpy as np
import unittest
import re
import random
from math import sqrt,pi,e,log
i_=np.complex(0,1)
####
## Gates
####
## One qubit gates
# Hadamard gate
H=1./sqrt(2)*np.matrix('1 1; 1 -1') 
# Pauli gates
X=np.matrix('0 1; 1 0')
Y=np.matrix([[0, -i_],[i_, 0]])
Z=np.matrix([[1,0],[0,-1]])
W=1/sqrt(2)*(X+Z)
V=1/sqrt(2)*(-X+Z)
eye=np.eye(2,2)

S=np.matrix([[1,0],[0,i_]])
Sdagger=np.matrix([[1,0],[0,-i_]]) # convenience Sdagger = S.conjugate().transpose()

T=np.matrix([[1,0],[0, e**(i_*pi/4.)]])
Tdagger=np.matrix([[1,0],[0, e**(-i_*pi/4.)]]) # convenience Tdagger= T.conjugate().transpose()

## Two qubit gates
# CNOT Gate
CNOT=np.matrix('1 0 0 0; 0 1 0 0; 0 0 0 1; 0 0 1 0')

####
## States
####
## One qubit states (basis)
# standard basis (z)
zero_state=np.matrix('1; 0')
one_state=np.matrix('0; 1')
# diagonal basis (x)
plus_state=1/sqrt(2)*np.matrix('1; 1')
minus_state=1/sqrt(2)*np.matrix('1; -1')
# circular basis (y)
plusi_state=1/sqrt(2)*np.matrix([[1],[i_]])    # also known as clockwise arrow state
minusi_state=1/sqrt(2)*np.matrix([[1],[-i_]])  # also known as counterclockwise arrow state

# bell state = 1/sqrt(2)(|00>+|11>")
bell_state = 1/sqrt(2)*np.matrix('1 0; 0 1')

## Two qubit states (basis)
# To derive the ordering you do ((+) is outer product):
# Symbolically: |00> = |0> (+) |0>; gives 4x1 
# In Python: np.kron(zero_state,zero_state)
two_qubits_00=np.kron(zero_state,zero_state)
two_qubits_01=np.kron(zero_state,one_state)
two_qubits_10=np.kron(one_state,zero_state)
two_qubits_11=np.kron(one_state,one_state)

# To operate a gate which operates on one qubit on elements of entangled 2-qubit state
# TODO: I think I should rather change the operator than the state, but this passes the test cases
qubits_00_state=two_qubits_00.reshape(2,2)
qubits_01_state=two_qubits_01.reshape(2,2)
qubits_10_state=two_qubits_10.reshape(2,2)
qubits_11_state=two_qubits_11.reshape(2,2)

## Three qubit states (basis)
three_qubits_000=np.kron(two_qubits_00,zero_state)
three_qubits_001=np.kron(two_qubits_00,one_state)
three_qubits_010=np.kron(two_qubits_01,zero_state)
three_qubits_011=np.kron(two_qubits_01,one_state)
three_qubits_100=np.kron(two_qubits_10,zero_state)
three_qubits_101=np.kron(two_qubits_10,one_state)
three_qubits_110=np.kron(two_qubits_11,zero_state)
three_qubits_111=np.kron(two_qubits_11,one_state)

# Four qubit states (basis)
four_qubits_0000=np.kron(three_qubits_000,zero_state)
four_qubits_0001=np.kron(three_qubits_000,one_state)
four_qubits_0010=np.kron(three_qubits_001,zero_state)
four_qubits_0011=np.kron(three_qubits_001,one_state)
four_qubits_0100=np.kron(three_qubits_010,zero_state)
four_qubits_0101=np.kron(three_qubits_010,one_state)
four_qubits_0110=np.kron(three_qubits_011,zero_state)
four_qubits_0111=np.kron(three_qubits_011,one_state)
four_qubits_1000=np.kron(three_qubits_100,zero_state)
four_qubits_1001=np.kron(three_qubits_100,one_state)
four_qubits_1010=np.kron(three_qubits_101,zero_state)
four_qubits_1011=np.kron(three_qubits_101,one_state)
four_qubits_1100=np.kron(three_qubits_110,zero_state)
four_qubits_1101=np.kron(three_qubits_110,one_state)
four_qubits_1110=np.kron(three_qubits_111,zero_state)
four_qubits_1111=np.kron(three_qubits_111,one_state)

# Five qubit states (basis)
five_qubits_00000=np.kron(four_qubits_0000,zero_state)
five_qubits_00001=np.kron(four_qubits_0000,one_state)
five_qubits_00010=np.kron(four_qubits_0001,zero_state)
five_qubits_00011=np.kron(four_qubits_0001,one_state)
five_qubits_00100=np.kron(four_qubits_0010,zero_state)
five_qubits_00101=np.kron(four_qubits_0010,one_state)
five_qubits_00110=np.kron(four_qubits_0011,zero_state)
five_qubits_00111=np.kron(four_qubits_0011,one_state)
five_qubits_01000=np.kron(four_qubits_0100,zero_state)
five_qubits_01001=np.kron(four_qubits_0100,one_state)
five_qubits_01010=np.kron(four_qubits_0101,zero_state)
five_qubits_01011=np.kron(four_qubits_0101,one_state)
five_qubits_01100=np.kron(four_qubits_0110,zero_state)
five_qubits_01101=np.kron(four_qubits_0110,one_state)
five_qubits_01110=np.kron(four_qubits_0111,zero_state)
five_qubits_01111=np.kron(four_qubits_0111,one_state)
five_qubits_10000=np.kron(four_qubits_1000,zero_state)
five_qubits_10001=np.kron(four_qubits_1000,one_state)
five_qubits_10010=np.kron(four_qubits_1001,zero_state)
five_qubits_10011=np.kron(four_qubits_1001,one_state)
five_qubits_10100=np.kron(four_qubits_1010,zero_state)
five_qubits_10101=np.kron(four_qubits_1010,one_state)
five_qubits_10110=np.kron(four_qubits_1011,zero_state)
five_qubits_10111=np.kron(four_qubits_1011,one_state)
five_qubits_11000=np.kron(four_qubits_1100,zero_state)
five_qubits_11001=np.kron(four_qubits_1100,one_state)
five_qubits_11010=np.kron(four_qubits_1101,zero_state)
five_qubits_11011=np.kron(four_qubits_1101,one_state)
five_qubits_11100=np.kron(four_qubits_1110,zero_state)
five_qubits_11101=np.kron(four_qubits_1110,one_state)
five_qubits_11110=np.kron(four_qubits_1111,zero_state)
five_qubits_11111=np.kron(four_qubits_1111,one_state)

def get_probability(coeff):
	return (coeff*coeff.conjugate()).real

def get_probabilities(state):
	return [get_probability(x) for x in state.flat]

def get_correlated_expectation(state):
	probs=get_probabilities(state)
	return probs[0]+probs[3]-probs[1]-probs[2]

def pretty_print_probabilities(state):
	if state.shape == (2,2):
		sa00,sa01,sa10,sa11=state.item(0),state.item(1),state.item(2),state.item(3)
		p00,p01,p10,p11=[get_probability(x) for x in [sa00,sa01,sa10,sa11]]
		print """
		%r|00>+%r|01>+%r|10>+%r|11>:
		Pr(|00>)=%f; Pr(|01>)=%f; Pr(|10>)=%f; Pr(|11>)=%f
		<state> = %f
		""" % (sa00,sa01,sa10,sa11,p00,p01,p10,p11,p00+p11-p01-p10)
	elif state.shape == (2,1):
		print """
		%r|0>+%r|1>:
		Pr(|0>)=%f
		Pr(|1>)=%f
		""" % (state.item(0),
			state.item(1),
			get_probability(state.item(0)),
			get_probability(state.item(1))
			)
	elif state.shape == (4,1):
		pretty_print_probabilities(state.reshape(2,2))
	else:
		print "don't recognize this shape cannot pretty print"

def change_to_x_basis(state):
	return H*state

def change_to_y_basis(state):
	return H*Sdagger*state

def change_to_w_basis(state):
	# W=1/sqrt(2)*(X+Z)
	return H*T*H*S*state

def change_to_v_basis(state):
	# V=1/sqrt(2)*(-X+Z)
	return H*Tdagger*H*S*state

def expectation_x(state):
	state_x=change_to_x_basis(state)
	prob_zero_state=(state_x.item(0)*state_x.item(0).conjugate()).real
	prob_one_state=(state_x.item(1)*state_x.item(1).conjugate()).real
	return prob_zero_state-prob_one_state	

def expectation_y(state):
	state_y=change_to_y_basis(state)
	prob_zero_state=(state_y.item(0)*state_y.item(0).conjugate()).real
	prob_one_state=(state_y.item(1)*state_y.item(1).conjugate()).real
	return prob_zero_state-prob_one_state

def expectation_z(state):
	state_z=state
	prob_zero_state=(state_z.item(0)*state_z.item(0).conjugate()).real
	prob_one_state=(state_z.item(1)*state_z.item(1).conjugate()).real
	return prob_zero_state-prob_one_state


def get_first_qubit(two_qubit_state):
	return get_individual_qubits(two_qubit_state)[0]

def get_second_qubit(two_qubit_state):
	return get_individual_qubits(two_qubit_state)[1]

def get_individual_qubits(two_qubit_state):
	"""just returns either a zero or one state equal to the target value of the CNOT output. 
	Throws exception if not a pure two qubit state"""
	if np.allclose(two_qubit_state,two_qubits_00):
		return (zero_state,zero_state)
	elif np.allclose(two_qubit_state,two_qubits_11):
		return (one_state,one_state)
	elif np.allclose(two_qubit_state,two_qubits_01):
		return (zero_state,one_state)
	elif np.allclose(two_qubit_state,two_qubits_10):
		return (one_state,zero_state)
	else:
		# TODO:
		raise Exception("TODO: Entangled qubits not represented yet in quantum computer implementation. Can currently do manual calculations; see TestBellState for Examples")

def measure(state):
	"""finally some probabilities, whee. To properly use, set the qubit you measure to the result of this function
		to collapse it. state=measure(state) """
	state_z=state
	prob_zero_state=(state_z.item(0)*state_z.item(0).conjugate()).real
	prob_one_state=(state_z.item(1)*state_z.item(1).conjugate()).real
	rand=random.random()
	if rand<prob_zero_state:
		return zero_state
	if rand==prob_zero_state:
		return random.choice([zero_state,one_state])
	else:
		return one_state
		


def get_bloch(state):
	return np.array((expectation_x(state),expectation_y(state),expectation_z(state)))

def get_bloch_2(state):
	""" equal to get_bloch just a different way of calculating things. Used for testing get_bloch. """
	return np.array((((state*state.conjugate().transpose()*X).trace()).item(0),((state*state.conjugate().transpose()*Y).trace()).item(0),((state*state.conjugate().transpose()*Z).trace()).item(0)))


class Qubit(object):
	def __init__(self,name,state=zero_state,entangled=None):
		self.entangled=None
		self.state=state
		self.name = name
		self.noop = False # after a measurement set this so that we can allow no further operations. Set to Bloch coords if bloch operation performed
	def get_num_qubits(self):
		num_qubits=log(self.state.shape[0],2)
		if self.state.shape[1]!=1 or num_qubits not in [1,2,3,4,5]:
			raise Exception("unrecognized state shape")
		else:
			return num_qubits
	def __eq__(self,other):
		return self.name==other.name and self.noop==other.noop and np.allclose(self.state,other.state) and (self.entangled==other.entangled==None or set(self.entangled)==set(other.entangled)) 

class QubitCollection(object):
	def __init__(self,qubits):
		self.qubits={}
		for q in qubits:
			self.qubits[q.name]=q
	def get_qubit_named(self,name):
		return self.qubits[name]

class TestQubit(unittest.TestCase):
	def setUp(self):
		self.q0 = Qubit("q0")
		self.q1 = Qubit("q1")
	def tearDown(self):
		self.q0=None
		self.q1=None
	def test_get_num_qubits(self):
		self.assertTrue(self.q0.get_num_qubits()==self.q0.get_num_qubits()==1)
	def test_equality(self):
		self.assertEqual(self.q0,self.q0)
		self.assertNotEqual(self.q0,self.q1)

class QuantumComputer(object):
	"""This class is meant to simulate the 5-qubit IBM quantum computer, 
		and be able to interpret the auto generated programs on the site."""
	def __init__(self):
		self.qubits=QubitCollection([Qubit("q0"),Qubit("q1"),Qubit("q2"),Qubit("q3"),Qubit("q4")])
	def reset():
		self.qubits=QubitCollection([Qubit("q0"),Qubit("q1"),Qubit("q2"),Qubit("q3"),Qubit("q4")])

	def qubit_states_equal(self,name,state):
		return np.allclose(self.qubits.get_qubit_named(name).state,state)

	def bloch_coords_equal(self,name,coords):
		return np.allclose(self.qubits.get_qubit_named(name).noop,coords)

	def apply_gate(self,gate,on_qubit_name):
		on_qubit=self.qubits.get_qubit_named(on_qubit_name)
		if on_qubit.noop:
			raise Exception("This qubit has been measured previously, no more gates allowed")

		if on_qubit.get_num_qubits()==1 and not on_qubit.entangled:
			on_qubit.state=gate*on_qubit.state
		else:
			raise Exception("We don't applying gates to entanbled states yet")

	def apply_two_qubit_gate(self,gate,control_qubit_name,target_qubit_name):
		control_qubit=self.qubits.get_qubit_named(control_qubit_name)
		target_qubit=self.qubits.get_qubit_named(target_qubit_name)
		if control_qubit.noop or target_qubit.noop:
			raise Exception("Control or target qubit has been measured previously, no more gates allowed")
		if control_qubit.get_num_qubits()==1 and target_qubit.get_num_qubits()==1 and not control_qubit.entangled and not target_qubit.entangled:
			# currently only supported if we only have one target qubit (ourselves) and output is easily separated
			combined_state=np.kron(control_qubit.state,target_qubit.state)
			target_qubit.state=get_second_qubit(gate*combined_state)
		else:
			raise Exception("We don't support other modes of two qubit gates yet")
	def bloch(self,qubit_name):
		on_qubit=self.qubits.get_qubit_named(qubit_name)
		on_qubit.noop=get_bloch(on_qubit.state)
	def measure(self,qubit_name):
		on_qubit=self.qubits.get_qubit_named(qubit_name)
		on_qubit.state=measure(on_qubit.state)
		on_qubit.noop=True

	def execute(self,program):
		"""Time for some very lazy meta programming!
		"""
		# Transforming IBM's language to my variables
		lines=program.split(';')
		translation=[
			['q[0]','"q0"'],
			['q[1]','"q1"'],
			['q[2]','"q2"'],
			['q[3]','"q3"'],
			['q[4]','"q4"'],
			['bloch ',r'self.bloch('],
			['measure ',r'self.measure('],
			['id ','self.apply_gate(eye,'],
			['sdg ','self.apply_gate(Sdagger,'],
			['tdg ','self.apply_gate(Tdagger,'],
			['h ','self.apply_gate(H,'],
			['t ','self.apply_gate(T,'],
			['s ','self.apply_gate(S,'],
			['x ','self.apply_gate(X,'],
			['y ','self.apply_gate(Y,'],
			['z ','self.apply_gate(Z,'],
			]
		cnot_re=re.compile('^cx (q\[[0-4]\]), (q\[[0-4]\])$')
		for l in lines:
			l=l.strip()
			if not l: continue
			# CNOT operates on two qubits so gets special processing
			cnot=cnot_re.match(l)
			if cnot:
				control_qubit=cnot.group(1)
				target_qubit=cnot.group(2)
				l='self.apply_two_qubit_gate(CNOT,%s,%s'%(control_qubit,target_qubit)
			for k,v in translation:
				l=l.replace(k,v)
			l=l+')'
			# Now running the code
			exec l

class TestMeasure(unittest.TestCase):
	def test_measure_probs_plus(self):
		measurements=[]
		for i in range(100000):
		 	measurements+=[measure(plus_state)]
		result=(1.*sum(measurements))/len(measurements)
		self.assertAlmostEqual(result.item(0),0.5,places=2)
		self.assertAlmostEqual(result.item(1),0.5,places=2)
	def test_measure_probs_minus(self):
		measurements=[]
		for i in range(100000):
		 	measurements+=[measure(minus_state)]
		result=(1.*sum(measurements))/len(measurements)
		self.assertAlmostEqual(result.item(0),0.5,places=2)
		self.assertAlmostEqual(result.item(1),0.5,places=2)
	def test_collapse(self):
		result=None
		for i in range(100):
			if result==None:
				result=measure(minus_state)
			else:
				new_measure=measure(result)
				self.assertTrue(np.allclose(result,new_measure))
				result=new_measure				

class TestGetBloch(unittest.TestCase):
	def test_get_bloch(self):
		self.assertTrue(np.allclose(get_bloch(zero_state),np.array((0,0,1))))
		self.assertTrue(np.allclose(get_bloch(one_state),np.array((0,0,-1))))
		self.assertTrue(np.allclose(get_bloch(plusi_state),np.array((0,1,0))))
		self.assertTrue(np.allclose(get_bloch(minusi_state),np.array((0,-1,0))))
		self.assertTrue(np.allclose(get_bloch(Z*plus_state),np.array((-1,0,0))))
		self.assertTrue(np.allclose(get_bloch(Z*minus_state),np.array((1,0,0))))

		# assert the norms are 1 for cardinal points (obviously) but also for a few other points at higher T depth on the Bloch Sphere
		for state in [zero_state,one_state,plusi_state,minusi_state,Z*plus_state,H*T*Z*plus_state,H*T*H*T*H*T*Z*plus_state]:
			self.assertAlmostEqual(np.linalg.norm(get_bloch(state)),1.0)

class TestGetBloch2(unittest.TestCase):
	def test_get_bloch_2(self):
		self.assertTrue(np.allclose(get_bloch_2(zero_state),get_bloch(zero_state)))
		self.assertTrue(np.allclose(get_bloch_2(one_state),get_bloch(one_state)))
		self.assertTrue(np.allclose(get_bloch_2(plusi_state),get_bloch(plusi_state)))
		self.assertTrue(np.allclose(get_bloch_2(minusi_state),get_bloch(minusi_state)))
		self.assertTrue(np.allclose(get_bloch_2(Z*plus_state),get_bloch(Z*plus_state)))
		self.assertTrue(np.allclose(get_bloch_2(H*T*Z*plus_state),get_bloch(H*T*Z*plus_state))) # test for arbitrary gates

class TestTwoQubits(unittest.TestCase):
	def test_twoqubits(self):
		self.assertTrue(np.allclose(two_qubits_00,(zero_state*zero_state.conjugate().transpose()).reshape(4,1)))
		self.assertTrue(np.allclose(two_qubits_01,(zero_state*one_state.conjugate().transpose()).reshape(4,1)))
		self.assertTrue(np.allclose(two_qubits_10,(one_state*zero_state.conjugate().transpose()).reshape(4,1)))
		self.assertTrue(np.allclose(two_qubits_11,(one_state*one_state.conjugate().transpose()).reshape(4,1)))

class TestCNOTGate(unittest.TestCase):	
	def test_CNOT(self):
		self.assertTrue(np.allclose(CNOT*two_qubits_00,two_qubits_00))
		self.assertTrue(np.allclose(CNOT*two_qubits_01,two_qubits_01))
		self.assertTrue(np.allclose(CNOT*two_qubits_10,two_qubits_11))
		self.assertTrue(np.allclose(CNOT*two_qubits_11,two_qubits_10))

class TestTGate(unittest.TestCase):
	def test_T(self):
		# This is useful to check some of the exercises on IBM's quantum experience. 
		# "Ground truth" answers from IBM's calculations which unfortunately are not reported to high precision.
		red_state=S*T*H*T*H*zero_state
		green_state=S*H*T*H*T*H*T*H*S*T*H*T*H*zero_state
		blue_state=H*S*T*H*T*H*S*T*H*T*H*T*H*zero_state
		self.assertTrue(np.allclose(get_bloch(red_state),np.array((0.5,0.5,0.707)),rtol=1e-3))
		self.assertTrue(np.allclose(get_bloch(green_state),np.array((0.427,0.457,0.780)),rtol=1e-3))
		self.assertTrue(np.allclose(get_bloch(blue_state),np.array((0.457,0.427,0.780)),rtol=1e-3))
		# Checking norms
		for state in [red_state,green_state,blue_state]:
			self.assertAlmostEqual(np.linalg.norm(get_bloch(state)),1.0)
class TestBellState(unittest.TestCase):
	def test_bell_state(self):
		# manually computing some of this (verified results to match IBM)
		zz=bell_state
		pr_zz=get_probabilities(zz)
		corex_zz=get_correlated_expectation(zz)
		self.assertTrue(np.allclose(pr_zz,(0.5,0,0,0.5)))
		self.assertAlmostEqual(corex_zz,1)
		
		zw=change_to_w_basis(bell_state)
		pr_zw=get_probabilities(zw)
		corex_zw=get_correlated_expectation(zw)
		self.assertTrue(np.allclose(pr_zw,(0.426777,0.073223,0.073223,0.426777)))
		self.assertAlmostEqual(corex_zw,1/sqrt(2))

		zv=change_to_v_basis(bell_state)
		pr_zv=get_probabilities(zv)
		corex_zv=get_correlated_expectation(zv)
		self.assertTrue(np.allclose(pr_zv,(0.426777,0.073223,0.073223,0.426777)))
		self.assertAlmostEqual(corex_zv,1/sqrt(2))

		xw=change_to_w_basis(change_to_x_basis(bell_state))
		pr_xw=get_probabilities(xw)
		corex_xw=get_correlated_expectation(xw) 
		self.assertTrue(np.allclose(pr_xw,(0.426777,0.073223,0.073223,0.426777)))
		self.assertAlmostEqual(corex_xw,1/sqrt(2))

		xv=change_to_v_basis(change_to_x_basis(bell_state))
		pr_xv=get_probabilities(xv)
		corex_xv=get_correlated_expectation(xv)
		self.assertTrue(np.allclose(pr_xv,(0.073223,0.426777,0.426777,0.073223)))
		self.assertAlmostEqual(corex_xv,-1/sqrt(2))
		# Why is |C| = |<AB>| + |-<AB'>| + |<A'B>| + |<A'B'>|; instead of |<AB> + -<AB'> + <A'B> + <A'B'>|? Otherwise this result doesn't work out to be 2*sqrt(2)
		abs_chsh_c = abs(corex_zw) + abs(corex_zv) + abs(corex_xw) + abs(-corex_xv) 
		self.assertAlmostEqual(abs_chsh_c,2*sqrt(2))

# class TestGHZState(unittest.TestCase):
# 	def test_ghz_state(self):
# 		pass


class TestMultiQubitStates(unittest.TestCase):
	def test_basis(self):
		# Sanity checks
		# 1-qubit
		self.assertTrue(np.allclose(zero_state+one_state,np.matrix('1; 1')))
		eye=np.eye(2,2)
		for row,state in enumerate([zero_state,one_state]):
			self.assertTrue(np.allclose(state.transpose(),eye[row]))
		# 2-qubit
		self.assertTrue(np.allclose(two_qubits_00+two_qubits_01+two_qubits_10+two_qubits_11,np.matrix('1; 1; 1; 1')))
		eye=np.eye(4,4)
		for row,state in enumerate([two_qubits_00,two_qubits_01,two_qubits_10,two_qubits_11]):
			self.assertTrue(np.allclose(state.transpose(),eye[row]))
		# 3-qubit
		self.assertTrue(np.allclose(three_qubits_000+three_qubits_001+three_qubits_010+three_qubits_011+three_qubits_100+three_qubits_101+three_qubits_110+three_qubits_111,np.matrix('1; 1; 1; 1; 1; 1; 1; 1')))
		eye=np.eye(8,8)
		for row,state in enumerate([three_qubits_000,three_qubits_001,three_qubits_010,three_qubits_011,three_qubits_100,three_qubits_101,three_qubits_110,three_qubits_111]):
			self.assertTrue(np.allclose(state.transpose(),eye[row]))
		# 4-qubit
		self.assertTrue(np.allclose(four_qubits_0000+four_qubits_0001+four_qubits_0010+four_qubits_0011+four_qubits_0100+four_qubits_0101+four_qubits_0110+four_qubits_0111+four_qubits_1000+four_qubits_1001+four_qubits_1010+four_qubits_1011+four_qubits_1100+four_qubits_1101+four_qubits_1110+four_qubits_1111,np.matrix('1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1')))
		eye=np.eye(16,16)
		for row,state in enumerate([four_qubits_0000,four_qubits_0001,four_qubits_0010,four_qubits_0011,four_qubits_0100,four_qubits_0101,four_qubits_0110,four_qubits_0111,four_qubits_1000,four_qubits_1001,four_qubits_1010,four_qubits_1011,four_qubits_1100,four_qubits_1101,four_qubits_1110,four_qubits_1111]):
			self.assertTrue(np.allclose(state.transpose(),eye[row]))
		# 5-qubit
		self.assertTrue(np.allclose(five_qubits_00000+five_qubits_00001+five_qubits_00010+five_qubits_00011+five_qubits_00100+five_qubits_00101+five_qubits_00110+five_qubits_00111+five_qubits_01000+five_qubits_01001+five_qubits_01010+five_qubits_01011+five_qubits_01100+five_qubits_01101+five_qubits_01110+five_qubits_01111+five_qubits_10000+five_qubits_10001+five_qubits_10010+five_qubits_10011+five_qubits_10100+five_qubits_10101+five_qubits_10110+five_qubits_10111+five_qubits_11000+five_qubits_11001+five_qubits_11010+five_qubits_11011+five_qubits_11100+five_qubits_11101+five_qubits_11110+five_qubits_11111,np.matrix('1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1; 1')))
		eye=np.eye(32,32)
		for row,state in enumerate([five_qubits_00000,five_qubits_00001,five_qubits_00010,five_qubits_00011,five_qubits_00100,five_qubits_00101,five_qubits_00110,five_qubits_00111,five_qubits_01000,five_qubits_01001,five_qubits_01010,five_qubits_01011,five_qubits_01100,five_qubits_01101,five_qubits_01110,five_qubits_01111,five_qubits_10000,five_qubits_10001,five_qubits_10010,five_qubits_10011,five_qubits_10100,five_qubits_10101,five_qubits_10110,five_qubits_10111,five_qubits_11000,five_qubits_11001,five_qubits_11010,five_qubits_11011,five_qubits_11100,five_qubits_11101,five_qubits_11110,five_qubits_11111]):
			self.assertTrue(np.allclose(state.transpose(),eye[row]))

class TestQuantumComputer(unittest.TestCase):
	def setUp(self):
		self.qc=QuantumComputer()
	def test_apply_gate(self):
		self.qc.apply_gate(H*T*Sdagger*Tdagger*X*Y,"q0")
		self.assertTrue(self.qc.qubit_states_equal("q0",H*T*Sdagger*Tdagger*X*Y*zero_state))
	def test_apply_two_qubit_gate_target(self):
		self.assertTrue(self.qc.qubit_states_equal("q0",zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",zero_state))
		self.qc.apply_two_qubit_gate(CNOT,"q0","q1")
		self.assertTrue(self.qc.qubit_states_equal("q0",zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",zero_state))
		self.qc.apply_gate(X,"q0")
		self.qc.apply_two_qubit_gate(CNOT,"q0","q1")
		self.assertTrue(self.qc.qubit_states_equal("q0",one_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",one_state))
		self.qc.apply_two_qubit_gate(CNOT,"q0","q1")
		self.assertTrue(self.qc.qubit_states_equal("q0",one_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",zero_state))

	def test_execute_bluestate(self):
		"""Tests h,t,s,and bloch syntax on one qubit"""
		# This is a program to generate the 'blue state' in IBM's exercise
		program_blue_state="""h q[1];
			t q[1];
			h q[1];
			t q[1];
			h q[1];
			t q[1];
			s q[1];
			h q[1];
			t q[1];
			h q[1];
			t q[1];
			s q[1];
			h q[1];
			bloch q[1];"""
		self.qc.execute(program_blue_state)
		# check if we are in the blue state
		blue_state=H*S*T*H*T*H*S*T*H*T*H*T*H*zero_state
		self.assertTrue(self.qc.bloch_coords_equal("q1",get_bloch(blue_state)))
		# check to make sure we didn't change any other qubits in the QC

		for unchanged_state in ["q0","q2","q3","q4"]:
			self.assertTrue(self.qc.qubit_states_equal(unchanged_state,zero_state))
	def test_execute_X_Y_Z_Measure_Id_Sdag_Tdag(self):
		"""Tests z,y,measure,id,sdag,tdag syntax on all 5 qubits"""
		program_test_many="""sdg q[0];
			x q[1];
			x q[2];
			id q[3];
			z q[4];
			tdg q[0];
			y q[4];
			measure q[0];
			measure q[1];
			measure q[2];
			measure q[3];
			measure q[4];"""
		self.qc.execute(program_test_many)
		# result should be 01101
		self.assertTrue(self.qc.qubit_states_equal("q0",zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",one_state))
		self.assertTrue(self.qc.qubit_states_equal("q2",one_state))
		self.assertTrue(self.qc.qubit_states_equal("q3",zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q4",one_state))

	def test_execute_cnot(self):
		"""Tests cnot"""
		program_test_cnot="""x q[1];
			cx q[1], q[2];"""
		self.qc.execute(program_test_cnot)
		# result should be 01100
		self.assertTrue(self.qc.qubit_states_equal("q0",zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",one_state))
		self.assertTrue(self.qc.qubit_states_equal("q2",one_state))
		self.assertTrue(self.qc.qubit_states_equal("q3",zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q4",zero_state))


	def test_execute_many(self):
		"""Tests z,y,cnot,measure,id,sdag,tdag syntax on all 5 qubits"""
		program_test_many="""sdg q[0];
			x q[1];
			x q[2];
			id q[3];
			z q[4];
			tdg q[0];
			cx q[1], q[2];
			y q[4];
			measure q[0];
			measure q[1];
			measure q[2];
			measure q[3];
			measure q[4];"""
		self.qc.execute(program_test_many)
		# result should be 01001
		self.assertTrue(self.qc.qubit_states_equal("q0",zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q1",one_state))
		self.assertTrue(self.qc.qubit_states_equal("q2",zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q3",zero_state))
		self.assertTrue(self.qc.qubit_states_equal("q4",one_state))

	# # Bell state experiments
	# def test_bellstate_measurements(self):
	# 	#This tests two qubit entanglement and measurement

	# 	program_zz="""h q[1];
	# 		cx q[1], q[2];
	# 		measure q[1];
	# 		measure q[2];""" # "00",0.5; "11",0.5 # <zz> = 2
		
	# 	program_zw="""h q[1];
	# 		cx q[1], q[2];
	# 		s q[2];
	# 		h q[2];
	# 		t q[2];
	# 		h q[2];
	# 		measure q[1];
	# 		measure q[2]""" # "00",0.426777; "01",0.073223; "10",0.073223; "11",0.426777 # <zw> = 1/sqrt(2)

	# 	program_zv="""h q[1];
	# 		cx q[1], q[2];
	# 		s q[2];
	# 		h q[2];
	# 		tdg q[2];
	# 		h q[2];
	# 		measure q[1];
	# 		measure q[2];""" #"00",0.426777; "01",0.073223; "10",0.073223; "11",0.426777 # <zv> = 1/sqrt(2)

	# 	program_xw="""h q[1];
	# 		cx q[1], q[2];
	# 		h q[1];
	# 		s q[2];
	# 		h q[2];
	# 		t q[2];
	# 		h q[2];
	# 		measure q[1];
	# 		measure q[2];""" # "00",0.426777; "01",0.073223; "10",0.073223; "11",0.426777 # <xw> = 

	# 	program_xv="""h q[1];
	# 		cx q[1], q[2];
	# 		h q[1];
	# 		s q[2];
	# 		h q[2];
	# 		tdg q[2];
	# 		h q[2];
	# 		measure q[1];
	# 		measure q[2];""" #"00",0.073223; "01",0.426777; "10",0.426777; "11",0.073223; # <xv> =
	# 	# TODO: modify
	# 	raise Exception("TODO: Entangled qubits not represented yet in quantum computer implementation. Can currently do manual calculations; see TestBellState for Examples")
	# 	#self.qc.execute(program)
	# def test_ghz_measurements(self):
	# 	#This tests three qubit entaglement and measurement
	# 	# just creates a GHZ state
	# 	program_ghz="""h q[0];
	# 		h q[1];
	# 		x q[2];
	# 		cx q[1], q[2];
	# 		cx q[0], q[2];
	# 		h q[0];
	# 		h q[1];
	# 		h q[2];
	# 		measure q[0];
	# 		measure q[1];
	# 		measure q[2];"""# "000":0.5; "111":0.5
	# 	# now we measure it
	# 	program_ghz_measure_yyx="""h q[0];
	# 		h q[1];
	# 		x q[2];
	# 		cx q[1], q[2];
	# 		cx q[0], q[2];
	# 		h q[0];
	# 		h q[1];
	# 		h q[2];
	# 		sdg q[0];
	# 		sdg q[1];
	# 		h q[2];
	# 		h q[0];
	# 		h q[1];
	# 		measure q[2];
	# 		measure q[0];
	# 		measure q[1];""" # "000":0.25; "011": 0.25; "101": 0.25; "110":0.25

	# 	program_ghz_measure_yxy="""h q[0];
	# 		h q[1];
	# 		x q[2];
	# 		cx q[1], q[2];
	# 		cx q[0], q[2];
	# 		h q[0];
	# 		h q[1];
	# 		h q[2];
	# 		sdg q[0];
	# 		h q[1];
	# 		sdg q[2];
	# 		h q[0];
	# 		measure q[1];
	# 		h q[2];
	# 		measure q[0];
	# 		measure q[2];""" # "000":0.25; "011": 0.25; "101": 0.25; "110":0.25
	# 	program_ghz_measure_xyy="""h q[0];
	# 		h q[1];
	# 		x q[2];
	# 		cx q[1], q[2];
	# 		cx q[0], q[2];
	# 		h q[0];
	# 		h q[1];
	# 		h q[2];
	# 		h q[0];
	# 		sdg q[1];
	# 		sdg q[2];
	# 		measure q[0];
	# 		h q[1];
	# 		h q[2];
	# 		measure q[1];
	# 		measure q[2];""" # "000":0.25; "011": 0.25; "101": 0.25; "110":0.25

	# 	program_ghz_measure_xxx="""h q[0];
	# 		h q[1];
	# 		x q[2];
	# 		cx q[1], q[2];
	# 		cx q[0], q[2];
	# 		h q[0];
	# 		h q[1];
	# 		h q[2];
	# 		h q[0];
	# 		h q[1];
	# 		h q[2];
	# 		measure q[0];
	# 		measure q[1];
	# 		measure q[2];""" #"001":0.25; "010": 0.25; "100": 0.25; "111":0.25
	# 	# expectation of YYX should be n
	# 	# expectation of YXY whould be n
	# 	# expectation of XYY should be n
	# 	# expectation of XXX should be -n
	# 	# n ~ 3/4 TODO: calculate
	# 	# M=expectation_yyx*expectation_yxy*expectation_xyy*expectation_xxx=~-0.2

	def tearDown(self):
		self.qc=None


# creates superposition of 00 and 01
# sdg q[1];
# t q[1];
# t q[1];
# s q[1];
# h q[1];
# h q[0];
# h q[1];
# h q[0];
# h q[1];
# cx q[0], q[1];
# measure q[0];
# measure q[1];

if __name__ == '__main__':
 	unittest.main()
